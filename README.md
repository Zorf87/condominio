## Comandi utili artisan

- php artisan route:list
  mostra tutto l'elenco delle rotte
  ATTENZIONE: A volte c'è un problema con la plurarlizzazione e PHP non le crea correttamente
  Per forzare il nome in web.php aggiungere ->parameters(['nome php' => 'nome voluto'])
  es. Route::resource('anagrafiche', AnagraficheController::class)->parameters(['anagrafiche' => 'anagrafica']);
