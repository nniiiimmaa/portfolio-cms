export function showFormErrors(errors) {
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