/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/views/**/*.blade.php',
        './resources/js/**/*.{js,jsx,ts,tsx,vue}',
    ],
    theme: {
        extend: {
            colors: {
                brand: {
                    50: '#f0f9ff',
                    100: '#e0f2fe',
                    200: '#bae6fd',
                    300: '#7dd3fc',
                    400: '#38bdf8',
                    500: '#0ea5e9',
                    600: '#0284c7',
                    700: '#0369a1',
                    800: '#075985',
                    900: '#0c3d66',
                },
            },
            fontFamily: {
                sans: ['Inter', 'system-ui', 'sans-serif'],
            },
            fontSize: {
                'theme-xs': '0.75rem',
                'theme-sm': '0.875rem',
                'title-sm': '1.125rem',
            },
            boxShadow: {
                'theme-xs': '0 1px 2px 0 rgba(0, 0, 0, 0.05)',
                'theme-sm': '0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06)',
                'theme-md': '0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06)',
                'theme-lg': '0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05)',
            },
            spacing: {
                '4.5': '1.125rem',
                '5.5': '1.375rem',
            },
            borderRadius: {
                'theme-sm': '0.375rem',
                'theme-md': '0.5rem',
                'theme-lg': '0.75rem',
            },
            maxWidth: {
                '(--breakpoint-2xl)': 'var(--breakpoint-2xl)',
            },
            zIndex: {
                '99999': '99999',
                '9999': '9999',
                '999': '999',
                '99': '99',
                '1': '1',
            },
            animation: {
                ping: 'ping 2s cubic-bezier(0, 0, 0.2, 1) infinite',
            },
            keyframes: {
                ping: {
                    '75%, 100%': {
                        transform: 'scale(2)',
                        opacity: '0'
                    },
                },
            },
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
    ],
    darkMode: 'class',
}