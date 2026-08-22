<script setup lang="ts">
import {
    AlertDialogAction,
    AlertDialogCancel,
    AlertDialogContent,
    AlertDialogDescription,
    AlertDialogOverlay,
    AlertDialogPortal,
    AlertDialogRoot,
    AlertDialogTitle,
} from 'reka-ui';
import { useConfirm } from '@/composables/useConfirm';

const { isRevealed, options, confirm, cancel } = useConfirm();
</script>

<template>
    <AlertDialogRoot :open="isRevealed">
        <AlertDialogPortal>
            <AlertDialogOverlay
                class="fixed inset-0 z-30 bg-black/80 data-[state=closed]:animate-out data-[state=closed]:fade-out-0 data-[state=open]:animate-in data-[state=open]:fade-in-0"
            />
            <AlertDialogContent
                class="fixed top-[50%] left-[50%] z-[100] max-h-[85vh] w-[90vw] max-w-[500px] translate-x-[-50%] translate-y-[-50%] rounded-lg border border-border bg-background p-6 text-sm shadow-lg duration-200 focus:outline-none data-[state=closed]:animate-out data-[state=closed]:fade-out-0 data-[state=closed]:zoom-out-95 data-[state=open]:animate-in data-[state=open]:fade-in-0 data-[state=open]:zoom-in-95"
            >
                <AlertDialogTitle
                    class="m-0 text-lg font-semibold text-foreground"
                >
                    {{ options.title || 'Sei sicuro?' }}
                </AlertDialogTitle>
                <AlertDialogDescription
                    class="mt-2 mb-5 text-sm leading-normal text-muted-foreground"
                >
                    {{
                        options.description ||
                        'Questa azione non può essere annullata.'
                    }}
                </AlertDialogDescription>
                <div class="flex justify-end gap-3">
                    <AlertDialogCancel
                        class="inline-flex h-9 items-center justify-center rounded-md border border-input bg-background px-4 text-sm font-medium shadow-xs transition-colors hover:bg-accent hover:text-accent-foreground focus-visible:outline-none disabled:pointer-events-none disabled:opacity-50"
                        @click="cancel()"
                    >
                        {{ options.cancelText || 'Annulla' }}
                    </AlertDialogCancel>
                    <AlertDialogAction
                        :class="[
                            'inline-flex h-9 items-center justify-center rounded-md px-4 text-sm font-medium shadow-xs transition-colors focus-visible:outline-none disabled:pointer-events-none disabled:opacity-50',
                            options.variant === 'destructive'
                                ? 'bg-destructive text-white hover:bg-destructive/90'
                                : 'bg-primary text-primary-foreground hover:bg-primary/90',
                        ]"
                        @click="confirm()"
                    >
                        {{ options.confirmText || 'Conferma' }}
                    </AlertDialogAction>
                </div>
            </AlertDialogContent>
        </AlertDialogPortal>
    </AlertDialogRoot>
</template>
