<script setup>
import { getCurrentInstance } from 'vue';

const i18n = getCurrentInstance().proxy.$i18n;

const applySettings = () => {
    applyLocale();
    applyTheme();
};

const applyLocale = () => {
    i18n.locale = localStorage.getItem('language');
};

const applyTheme = () => {
    const dark = localStorage.getItem('theme') === 'dark';

    const el = document.querySelector('html');

    el.classList.add(dark ? 'dark' : 'light');
    el.classList.remove(dark ? 'light' : 'dark');
};

applySettings();

document.addEventListener('settingsChanged', () => applySettings());
</script>

<template>
    <router-view></router-view>
</template>
