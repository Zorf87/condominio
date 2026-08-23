import { createInertiaApp } from '@inertiajs/vue3';
import { TanStackDevtools } from '@tanstack/vue-devtools';
import { tableDevtoolsPlugin } from '@tanstack/vue-table-devtools';
import { createApp, defineComponent, h } from 'vue';
import { initializeTheme } from '@/composables/useAppearance';
import AppLayout from '@/layouts/AppLayout.vue';
import AuthLayout from '@/layouts/AuthLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import { initializeFlashToast } from '@/lib/flashToast';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => (title ? `${title} - ${appName}` : appName),
    layout: (name) => {
        switch (true) {
            case name === 'Welcome':
                return null;
            case name.startsWith('auth/'):
                return AuthLayout;
            case name.startsWith('settings/'):
                return [AppLayout, SettingsLayout];
            default:
                return AppLayout;
        }
    },
    progress: {
        color: '#4B5563',
    },
    setup({ el, App, props, plugin }) {
        const Root = defineComponent({
            setup() {
                return () => [
                    h(App, props),
                    import.meta.env.DEV
                        ? h(TanStackDevtools, {
                              plugins: [tableDevtoolsPlugin({})],
                          })
                        : null,
                ];
            },
        });

        createApp(Root).use(plugin).mount(el!);
    },
});

// This will set light / dark mode on page load...
initializeTheme();

// This will listen for flash toast data from the server...
initializeFlashToast();
