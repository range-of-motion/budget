<script setup>
const applyTheme = () => {
    const dark = localStorage.getItem('theme') === 'dark';

    const el = document.querySelector('html');

    el.classList.add(dark ? 'dark' : 'light');
    el.classList.remove(dark ? 'light' : 'dark');
};

applyTheme();

document.addEventListener('themeChanged', () => applyTheme());
</script>

<template>
    <router-view></router-view>
</template>
