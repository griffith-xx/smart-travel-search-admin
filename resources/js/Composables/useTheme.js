import { ref, watch } from "vue";

const darkModeKey = "darkMode";
const isDarkMode = ref(false);

const getSystemPreference = () => {
    return window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
};

const applyDarkMode = (value) => {
    if (value) {
        document.documentElement.classList.add("p-dark");
    } else {
        document.documentElement.classList.remove("p-dark");
    }
};

const toggleDarkMode = () => {
    isDarkMode.value = !isDarkMode.value;
};

const saveDarkMode = (value) => {
    try {
        localStorage.setItem(darkModeKey, JSON.stringify(value));
    } catch (error) {
        console.warn('Failed to save dark mode preference:', error);
    }
};

const loadDarkMode = () => {
    try {
        const stored = localStorage.getItem(darkModeKey);
        if (stored !== null) {
            isDarkMode.value = JSON.parse(stored);
        } else {
            isDarkMode.value = getSystemPreference();
        }
    } catch (error) {
        console.warn('Failed to load dark mode preference:', error);
        isDarkMode.value = getSystemPreference();
    }
};

watch(isDarkMode, (newValue) => {
    applyDarkMode(newValue);
    saveDarkMode(newValue);
}, { immediate: false });

if (window.matchMedia) {
    const mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
    mediaQuery.addEventListener('change', (e) => {
        if (localStorage.getItem(darkModeKey) === null) {
            isDarkMode.value = e.matches;
        }
    });
}

loadDarkMode();
applyDarkMode(isDarkMode.value);

export {
    isDarkMode,
    toggleDarkMode,
};