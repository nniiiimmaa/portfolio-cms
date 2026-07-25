<template>
    <AdminLayout title="Dashboard">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Dashboard
            </h2>
        </template>
        <div class="py-12">
            <span class="material-symbols-outlined">construction</span>
            <p class="text-center text-[3vw]">Under construction</p>
                <pre class="hidden">
                    
                    📊 Statistics
                    ✅ Top Statistics Cards (KPIs)
                    ✅ Messages per Month (Line Chart)
                    ✅ Visitors per Month (Line Chart)
                    ✅ CV Downloads per Month
                    📋 Management
                    ✅ Recent Activity
                    ✅ Missing Content Alerts
                </pre>
        </div>
    </AdminLayout>
</template>
<script setup>
import AdminLayout from '@/Layouts/Admin/AdminLayout.vue';
</script>
<style scoped>
span {
    width: 100%;
    font-size: 30vw;
    text-align: center;
}
</style>