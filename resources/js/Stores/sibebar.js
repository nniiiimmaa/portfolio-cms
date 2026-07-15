import { ref } from 'vue'
import { defineStore } from 'pinia'

export const useSidebarStore = defineStore('sidebar', () => {

    // -----------------------------
    // Refs & Reactives & Vars
    // -----------------------------
    const open = ref(false)


    // -----------------------------
    // Methods
    // -----------------------------
    const openSidebar = () => {
        open.value = true
    }

    const closeSidebar = () => {
        open.value = false
    }

    const toggleSidebar = () => {
        open.value = !open.value
    }


    return {
        open,
        openSidebar,
        closeSidebar,
        toggleSidebar,
    }
})