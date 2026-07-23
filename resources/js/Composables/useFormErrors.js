import { useToast } from 'primevue/usetoast'

export function useFormErrors() {
    const toast = useToast()

    /**
     * Show the first validation error
     *
     * @param {Object} errors
     */
    const showFormErrors = (errors) => {
        const firstError = Object.values(errors)[0]

        if (firstError) {
            toast.add({
                severity: 'error',
                summary: 'Validation Error',
                detail: firstError,
                life: 4000,
            })
        }
    }

    return {
        showFormErrors,
    }
}