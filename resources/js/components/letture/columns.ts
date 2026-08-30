// components/letture/columns.ts
import { createColumnHelper } from '@tanstack/vue-table';
import { useDateFormat } from '@vueuse/core';
import { h } from 'vue';
import { useNumberFormat } from '@/composables/useFormatFormat';
import type { DataTableFeatures } from './features';

export interface Lettura {
    id: number;
    anagrafica: any; //qui type Anagrafica
    data_lettura: string;
    valore: number;
    unita_misura: any; // qui type UnitaMisura
}

// Use `accessor` for data columns and `display` for columns without one.
const columnHelper = createColumnHelper<DataTableFeatures, Lettura>();

export const columns = columnHelper.columns([
    columnHelper.accessor('data_lettura', {
        header: 'Data lettura',
        size: 120,
        cell: ({ getValue }) =>
            h(
                'div',
                { class: 'capitalize' },
                useDateFormat(getValue(), 'DD/MM/YYYY').value,
            ),
    }),
    columnHelper.accessor('anagrafica', {
        header: 'Anagrafica',
        size: 200,
        cell: ({ getValue }) => `${getValue().nome}`,
    }),
    columnHelper.accessor('valore', {
        header: 'Valore',
        size: 140,
        cell: ({ row, getValue }) =>
            `${
                useNumberFormat(() => getValue()).value
            } ${row.original.unita_misura.simbolo}`,
    }),
    columnHelper.accessor((row) => row.unita_misura.id, {
        id: 'unita_misura', // stesso id usato dal filtro
        header: 'Tipo lettura',
        size: 140,
        filterFn: 'equalsId',
        cell: ({ row }) =>
            h('div', { class: 'capitalize' }, row.original.unita_misura.tipo),
    }),
]);
