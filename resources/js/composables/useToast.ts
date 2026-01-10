import { getCurrentInstance } from 'vue';

export function useToast() {
    const instance = getCurrentInstance();
    const toastContainer = instance?.appContext.config.globalProperties.$toast;

    if (!toastContainer) {
        console.warn('Toast container not found');
        return {
            success: (msg: string) => console.log('Success:', msg),
            error: (msg: string) => console.log('Error:', msg),
            warning: (msg: string) => console.log('Warning:', msg),
            info: (msg: string) => console.log('Info:', msg),
        };
    }

    return {
        success: (message: string) => toastContainer.success(message),
        error: (message: string) => toastContainer.error(message),
        warning: (message: string) => toastContainer.warning(message),
        info: (message: string) => toastContainer.info(message),
    };
}
