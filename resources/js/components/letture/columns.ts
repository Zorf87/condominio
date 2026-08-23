// components/letture/columns.ts
import { createColumnHelper } from '@tanstack/vue-table';
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
    columnHelper.accessor('data_lettura', { header: 'Data' }),
    columnHelper.accessor('valore', {
        header: 'Valore',
        cell: ({ row, getValue }) =>
            `${getValue()} ${row.original.unita_misura.simbolo}`,
    }),
    columnHelper.accessor((row) => row.anagrafica.nome, {
        id: 'anagrafica',
        header: 'Anagrafica',
    }),
]);
