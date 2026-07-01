const LogoIcon = ({ size = 24, className = '' }) => (
    <svg
        width={size}
        height={size}
        viewBox="0 0 24 24"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
        className={className}
        aria-hidden="true"
    >
        <path
            d="M3 10.5L12 6L21 10.5L12 15L3 10.5Z"
            fill="currentColor"
            fillOpacity="0.18"
        />
        <path
            d="M3 10.5L12 6L21 10.5L12 15L3 10.5Z"
            stroke="currentColor"
            strokeWidth="1.5"
            strokeLinejoin="round"
        />
        <path
            d="M21 10.5V13.5"
            stroke="currentColor"
            strokeWidth="1.5"
            strokeLinecap="round"
        />
        <path
            d="M7 12V15.5C7 16.88 9.24 18 12 18C14.76 18 17 16.88 17 15.5V12"
            stroke="currentColor"
            strokeWidth="1.5"
            strokeLinecap="round"
        />
        <path
            d="M12 18V20.5"
            stroke="currentColor"
            strokeWidth="2"
            strokeLinecap="round"
        />
        <path
            d="M10 18.75L12 21L14 18.75"
            stroke="currentColor"
            strokeWidth="2"
            strokeLinecap="round"
            strokeLinejoin="round"
        />
    </svg>
);

export default LogoIcon;
