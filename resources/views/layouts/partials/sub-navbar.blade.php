@php
    $isRtl = app()->getLocale() === 'ar';
    $gregorianDate = now()->locale($isRtl ? 'ar' : 'en')->translatedFormat('l، j F Y');
@endphp

<div class="sub-navbar d-none d-xl-flex" id="subNavbar" dir="{{ $isRtl ? 'rtl' : 'ltr' }}"
    data-is-rtl="{{ $isRtl ? '1' : '0' }}"
    data-fallback-city="{{ $isRtl ? 'القاهرة' : 'Cairo' }}"
    data-next-label="{{ $isRtl ? 'الصلاة القادمة:' : 'Next:' }}"
    data-location-unavailable="{{ $isRtl ? 'الموقع غير متاح' : 'Location unavailable' }}">
    <div class="sub-nav-container">
        <div class="sub-nav-left">
            <div class="sub-nav-item date-section">
                <i class="bi bi-calendar3"></i>
                <span class="gregorian" id="subNavGregorian">{{ $gregorianDate }}</span>
                <span class="divider">|</span>
                <span class="hijri" id="subNavHijri">...</span>
            </div>
            <div class="sub-nav-sep"></div>
            <div class="sub-nav-item clock-section">
                <i class="bi bi-clock"></i>
                <span class="live-time" id="subNavClock">--:--:--</span>
            </div>
        </div>

        <div class="sub-nav-right">
            <div class="sub-nav-item location-section">
                <i class="bi bi-geo-alt"></i>
                <span class="loc-name" id="subNavLocation">{{ $isRtl ? 'القاهرة' : 'Cairo' }}</span>
            </div>
            <div class="sub-nav-sep"></div>
            <div class="sub-nav-item weather-section">
                <div class="weather-info" id="subNavWeather">
                    <span class="loading-dots">...</span>
                </div>
            </div>
            <div class="sub-nav-sep"></div>
            <div class="sub-nav-item prayer-section">
                <i class="bi bi-moon-stars"></i>
                <span class="prayer-label">{{ $isRtl ? 'الصلاة القادمة:' : 'Next:' }}</span>
                <span class="prayer-name" id="subNavPrayerName">—</span>
                <span class="prayer-time" id="subNavPrayerTime">--:--</span>
            </div>
        </div>
    </div>
</div>

<script>
    (function () {
        const bar = document.getElementById('subNavbar');
        if (!bar) return;

        const isRtl = bar.dataset.isRtl === '1';
        const fallbackCity = bar.dataset.fallbackCity;
        const locationUnavailable = bar.dataset.locationUnavailable;

        const clockEl = document.getElementById('subNavClock');
        const hijriEl = document.getElementById('subNavHijri');
        const locationEl = document.getElementById('subNavLocation');
        const weatherEl = document.getElementById('subNavWeather');
        const prayerNameEl = document.getElementById('subNavPrayerName');
        const prayerTimeEl = document.getElementById('subNavPrayerTime');

        const prayers = [
            { id: 'Fajr', name: isRtl ? 'الفجر' : 'Fajr' },
            { id: 'Dhuhr', name: isRtl ? 'الظهر' : 'Dhuhr' },
            { id: 'Asr', name: isRtl ? 'العصر' : 'Asr' },
            { id: 'Maghrib', name: isRtl ? 'المغرب' : 'Maghrib' },
            { id: 'Isha', name: isRtl ? 'العشاء' : 'Isha' },
        ];

        function formatTime(date) {
            const hours = date.getHours();
            const minutes = String(date.getMinutes()).padStart(2, '0');
            const seconds = String(date.getSeconds()).padStart(2, '0');
            const ampm = hours >= 12 ? (isRtl ? 'م' : 'PM') : (isRtl ? 'ص' : 'AM');
            const displayHours = String(hours % 12 || 12).padStart(2, '0');
            return `${displayHours}:${minutes}:${seconds} ${ampm}`;
        }

        function updateClock() {
            if (clockEl) clockEl.textContent = formatTime(new Date());
        }

        function getWeatherIcon(code) {
            if (code <= 3) return 'bi-sun';
            if (code <= 48) return 'bi-cloud';
            if (code <= 67) return 'bi-cloud-rain';
            return 'bi-cloud-snow';
        }

        function calculateNextPrayer(timings) {
            const now = new Date();
            const currentTimeMin = now.getHours() * 60 + now.getMinutes();

            for (const prayer of prayers) {
                const [hours, minutes] = timings[prayer.id].split(':');
                const prayerTotalMinutes = parseInt(hours, 10) * 60 + parseInt(minutes, 10);

                if (prayerTotalMinutes > currentTimeMin) {
                    if (prayerNameEl) prayerNameEl.textContent = prayer.name;
                    if (prayerTimeEl) prayerTimeEl.textContent = timings[prayer.id];
                    return;
                }
            }

            if (prayerNameEl) prayerNameEl.textContent = prayers[0].name;
            if (prayerTimeEl) prayerTimeEl.textContent = timings.Fajr;
        }

        async function fetchData(lat, lon) {
            try {
                const weatherRes = await fetch(`https://api.open-meteo.com/v1/forecast?latitude=${lat}&longitude=${lon}&current_weather=true`);
                if (weatherRes.ok) {
                    const weatherData = await weatherRes.json();
                    if (weatherData?.current_weather && weatherEl) {
                        const temp = Math.round(weatherData.current_weather.temperature || 0);
                        const icon = getWeatherIcon(weatherData.current_weather.weathercode);
                        weatherEl.innerHTML = `<i class="bi ${icon}"></i><span>${temp}°C</span>`;
                    }
                }

                const prayerRes = await fetch(`https://api.aladhan.com/v1/timings/${Math.floor(Date.now() / 1000)}?latitude=${lat}&longitude=${lon}&method=5`);
                if (prayerRes.ok) {
                    const prayerData = await prayerRes.json();
                    if (prayerData.data) {
                        const hijri = prayerData.data.date.hijri;
                        if (hijriEl) {
                            hijriEl.textContent = isRtl
                                ? `${hijri.weekday.ar}، ${hijri.day} ${hijri.month.ar} ${hijri.year}`
                                : `${hijri.weekday.en}, ${hijri.day} ${hijri.month.en} ${hijri.year}`;
                        }

                        const city = prayerData.data.meta.timezone.split('/')[1]?.replace('_', ' ') || fallbackCity;
                        if (locationEl) locationEl.textContent = city;
                        calculateNextPrayer(prayerData.data.timings);
                    }
                }
            } catch (error) {
                console.error('SubNavbar fetch error:', error);
                if (locationEl && locationEl.textContent === fallbackCity) {
                    locationEl.textContent = locationUnavailable;
                }
            }
        }

        function initHijriFallback() {
            if (!hijriEl) return;
            try {
                const hDate = new Date().toLocaleDateString(isRtl ? 'ar-SA-u-ca-islamic-uma' : 'en-US-u-ca-islamic-uma', {
                    weekday: 'long', day: 'numeric', month: 'long', year: 'numeric'
                });
                hijriEl.textContent = hDate;
            } catch (e) {
                hijriEl.textContent = '—';
            }
        }

        updateClock();
        setInterval(updateClock, 1000);
        initHijriFallback();

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => fetchData(position.coords.latitude, position.coords.longitude),
                () => fetchData(30.0444, 31.2357)
            );
        } else {
            fetchData(30.0444, 31.2357);
        }
    })();
</script>
