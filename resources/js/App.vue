<template>
    <header>
        <navigation></navigation>
    </header>
    <main>
        <router-view></router-view>
    </main>

</template>

<script>
import Navigation from './components/Navigation.vue';

export default {
    components: {
        Navigation,
    }
}
</script>

