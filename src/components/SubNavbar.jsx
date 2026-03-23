import React, { useState, useEffect } from 'react';
import { useTranslation } from 'react-i18next';
import './SubNavbar.css';

const SubNavbar = () => {
    const { i18n } = useTranslation();
    const isRtl = i18n.language?.startsWith('ar');

    const [location, setLocation] = useState(null);
    const [weather, setWeather] = useState(null);
    const [prayerTimes, setPrayerTimes] = useState(null);
    const [dates, setDates] = useState({ gregory: '', hijri: '' });
    const [nextPrayer, setNextPrayer] = useState({ name: '', time: '' });

    const [currentTime, setCurrentTime] = useState(new Date());

    useEffect(() => {
        const timer = setInterval(() => setCurrentTime(new Date()), 1000);
        return () => clearInterval(timer);
    }, []);

    useEffect(() => {
        // Init Dates
        const gDate = new Date().toLocaleDateString(isRtl ? 'ar-EG' : 'en-GB', {
            weekday: 'long', day: 'numeric', month: 'long', year: 'numeric'
        });
        const hDate = new Date().toLocaleDateString(isRtl ? 'ar-SA-u-ca-islamic-uma' : 'en-US-u-ca-islamic-uma', {
            weekday: 'long', day: 'numeric', month: 'long', year: 'numeric'
        });
        setDates({ gregory: gDate, hijri: hDate });

        // Geolocation
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition((position) => {
                const { latitude, longitude } = position.coords;
                fetchData(latitude, longitude);
            }, (err) => {
                console.error("Geolocation error:", err);
                // Fallback to Cairo coordinates if blocked
                fetchData(30.0444, 31.2357);
            });
        }
    }, [isRtl]);

    const formatTime = (date) => {
        const hours = date.getHours();
        const minutes = date.getMinutes().toString().padStart(2, '0');
        const seconds = date.getSeconds().toString().padStart(2, '0');
        const ampm = hours >= 12 ? (isRtl ? 'م' : 'PM') : (isRtl ? 'ص' : 'AM');
        const displayHours = (hours % 12 || 12).toString().padStart(2, '0');

        return `${displayHours}:${minutes}:${seconds} ${ampm}`;
    };

    const fetchData = async (lat, lon) => {
        try {
            // 1. Weather (Open-Meteo)
            const weatherRes = await fetch(`https://api.open-meteo.com/v1/forecast?latitude=${lat}&longitude=${lon}&current_weather=true`);
            if (!weatherRes.ok) throw new Error('Weather API error');
            const weatherData = await weatherRes.json();

            if (weatherData && weatherData.current_weather) {
                setWeather({
                    temp: Math.round(weatherData.current_weather.temperature || 0),
                    code: weatherData.current_weather.weathercode
                });
            }

            // 2. Prayer Times & Hijri Date (Aladhan)
            const prayerUrl = `https://api.aladhan.com/v1/timings/${Math.floor(Date.now() / 1000)}?latitude=${lat}&longitude=${lon}&method=5`;
            const prayerRes = await fetch(prayerUrl);
            if (!prayerRes.ok) throw new Error('Prayer API error');
            const prayerData = await prayerRes.json();

            if (prayerData.data) {
                setPrayerTimes(prayerData.data.timings);
                const hijri = prayerData.data.date.hijri;
                const hDate = isRtl
                    ? `${hijri.weekday.ar}، ${hijri.day} ${hijri.month.ar} ${hijri.year}`
                    : `${hijri.weekday.en}, ${hijri.day} ${hijri.month.en} ${hijri.year}`;

                setDates(prev => ({ ...prev, hijri: hDate }));
                // Use city name from timezone or meta if available
                const city = prayerData.data.meta.timezone.split('/')[1]?.replace('_', ' ') || (isRtl ? 'القاهرة' : 'Cairo');
                setLocation(city);
                calculateNextPrayer(prayerData.data.timings);
            }
        } catch (error) {
            console.error("Fetch Error:", error);
            // Minimal fallback if everything fails
            if (!location) setLocation(isRtl ? 'الموقع غير متاح' : 'Location context unavailable');
        }
    };

    const calculateNextPrayer = (timings) => {
        const now = new Date();
        const currentTimeMin = now.getHours() * 60 + now.getMinutes();

        const prayers = [
            { id: 'Fajr', name: isRtl ? 'الفجر' : 'Fajr' },
            { id: 'Dhuhr', name: isRtl ? 'الظهر' : 'Dhuhr' },
            { id: 'Asr', name: isRtl ? 'العصر' : 'Asr' },
            { id: 'Maghrib', name: isRtl ? 'المغرب' : 'Maghrib' },
            { id: 'Isha', name: isRtl ? 'العشاء' : 'Isha' }
        ];

        let found = false;
        for (const prayer of prayers) {
            const [hours, minutes] = timings[prayer.id].split(':');
            const prayerTotalMinutes = parseInt(hours) * 60 + parseInt(minutes);

            if (prayerTotalMinutes > currentTimeMin) {
                setNextPrayer({ name: prayer.name, time: timings[prayer.id] });
                found = true;
                break;
            }
        }

        if (!found) {
            setNextPrayer({ name: prayers[0].name, time: timings['Fajr'] });
        }
    };

    const getWeatherIcon = (code) => {
        if (code <= 3) return 'bi-sun'; // Clear
        if (code <= 48) return 'bi-cloud'; // Cloudy/Fog
        if (code <= 67) return 'bi-cloud-rain'; // Rain
        return 'bi-cloud-snow'; // Snow/Storm
    };

    return (
        <div className="sub-navbar" dir={isRtl ? 'rtl' : 'ltr'}>
            <div className="sub-nav-container">
                {/* Left Side: Dates & Live Clock */}
                <div className="sub-nav-left">
                    <div className="sub-nav-item date-section">
                        <i className="bi bi-calendar3"></i>
                        <span className="gregorian">{dates.gregory}</span>
                        <span className="divider">|</span>
                        <span className="hijri">{dates.hijri}</span>
                    </div>
                    <div className="sub-nav-sep d-none d-md-block"></div>
                    <div className="sub-nav-item clock-section">
                        <i className="bi bi-clock"></i>
                        <span className="live-time">{formatTime(currentTime)}</span>
                    </div>
                </div>

                {/* Right Side: Location, Weather, Prayers */}
                <div className="sub-nav-right">
                    <div className="sub-nav-item location-section">
                        <i className="bi bi-geo-alt"></i>
                        <span className="loc-name">{location || (isRtl ? 'القاهرة' : 'Cairo')}</span>
                    </div>
                    <div className="sub-nav-sep d-none d-md-block"></div>
                    <div className="sub-nav-item weather-section">
                        {weather ? (
                            <div className="weather-info">
                                <i className={`bi ${getWeatherIcon(weather.code)}`}></i>
                                <span>{weather.temp}°C</span>
                            </div>
                        ) : (
                            <span className="loading-dots">...</span>
                        )}
                    </div>
                    <div className="sub-nav-sep d-none d-md-block"></div>
                    <div className="sub-nav-item prayer-section">
                        <i className="bi bi-moon-stars"></i>
                        <span className="prayer-label d-none d-lg-inline">{isRtl ? 'الصلاة القادمة:' : 'Next:'}</span>
                        <span className="prayer-name">{nextPrayer.name}</span>
                        <span className="prayer-time">{nextPrayer.time}</span>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default SubNavbar;
