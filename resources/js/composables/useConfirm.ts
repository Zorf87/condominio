import { useConfirmDialog } from '@vueuse/core';
import { ref } from 'vue';

interface ConfirmOptions {
    title?: string;
    description?: string;
    confirmText?: string;
    cancelText?: string;
    variant?: 'default' | 'destructive';
}

const options = ref<ConfirmOptions>({});

const { isRevealed, reveal, confirm, cancel, onReveal } = useConfirmDialog();

onReveal((opts: ConfirmOptions) => {
    options.value = opts;
});

export function useConfirm() {
    function open(opts: ConfirmOptions = {}) {
        return reveal(opts);
    }

    return { isRevealed, options, open, confirm, cancel };
}
