<script setup>
import { onMounted } from 'vue';

onMounted(() => {
    const telegram = window.Telegram?.WebApp;

    telegram?.ready();
});
</script>

<template>
    <h1>SkillGive работает</h1>
</template>
