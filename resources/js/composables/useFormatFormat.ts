// composables/useNumberFormat.ts
import { computed, toValue } from 'vue';
import type { MaybeRefOrGetter } from 'vue';

export function useNumberFormat(
    value: MaybeRefOrGetter<number>,
    options?: Intl.NumberFormatOptions,
    locale: MaybeRefOrGetter<string> = 'it-IT',
) {
    return computed(() =>
        new Intl.NumberFormat(toValue(locale), {
            useGrouping: 'always', // ✅ forza il raggruppamento anche sotto 10.000
            ...options,
        }).format(toValue(value)),
    );
}
