# Laravel summary

### Dan 1
- Instalacija composer alata: https://getcomposer.org/download/
- Instalacija laravel installera i kreiranje novog projekta: https://laravel.com/docs/7.x/installation
- Kreiranje about stranice: kreiranje view-a (blade template), kreiranje rute u `routes/web.php` hvata request i vraća view https://laravel.com/docs/7.x/views
- Prosleđivanje podataka u view: https://laravel.com/docs/7.x/views#passing-data-to-views
- Povezivanje sa bazom podataka (unošenje usernamea, passworda i imena baze u .env fajl za konekciju na bazu podataka), pokretanje inicijalnih migracija komandom `php artisan migrate`
- Generisanje nove migracije komandom `php artisan make:migration create_table_naziv_tabele`https://laravel.com/docs/7.x/migrations#introduction i pokretanje migracije komandom `php artisan migrate`
### Dan 2
- Generisanje kontrolera komandom `php artisan make:controller NazivKontrolera`: https://laravel.com/docs/7.x/controllers
- Generisanje model klase, upotreba modela za slanje kverija ka bazi (Eloquent model, query builder itd): https://laravel.com/docs/7.x/eloquent
- Rutiranje, imenovane rute: https://laravel.com/docs/7.x/routing
- Kreiranje `layouts/app.blade.php` viewa koji definiše placeholdere za sekcije direktivom `@yields`. Ovaj view nasleđujemo u drugim viewovima i "uglavljujemo" sekcije upotrebom direktive `@section`: https://laravel.com/docs/7.x/blade#extending-blade
- Instalacija Bootstrapa i upotreba u viewovima: https://laravel.com/docs/7.x/frontend#introduction https://getbootstrap.com/docs/4.5/getting-started/introduction/
### Dan 4
- Forme za kreiranje novih objekata (redova u tabeli): https://laravel.com/docs/7.x/blade#forms 
- Upotreba bootstrapa za stilizovanje forme: https://getbootstrap.com/docs/4.0/components/forms/
- Insert i update u bazu upotrebom metoda Eloquent model klase (save vs mass assignment - fillable niz u klasi): https://laravel.com/docs/7.x/eloquent#inserting-and-updating-models
- Validacija podataka iz forme upotrebom `$request->validate($rules)` metode https://laravel.com/docs/7.x/validation#quick-writing-the-validation-logic
- Prebacivanje validacije u posebnu klasu koja nasleđuje `FormValidation` - generisanje klase komandom `php artisan make:request` https://laravel.com/docs/7.x/validation#form-request-validation
- Pravila za validaciju https://laravel.com/docs/7.x/validation#available-validation-rules
- Ispis grešaka u viewu https://laravel.com/docs/7.x/blade#validation-errors
- Kreiranje modela i migracije zajedno komandom `php artisan make:model --migration NazivModela`
- Definisanje stranog ključa upotrebom `$table->foreignId('model_id')->constrained()` https://laravel.com/docs/7.x/migrations#columns
- Definisanje relacije između modela https://laravel.com/docs/7.x/eloquent-relationships#introduction
- Upotreba relacija: `$model->relationship` vs `$model->relationship()` vs `Model::with('relationship')`
### Dan 5 - Autentifikacija
- Registracija: kreiranje kontrolera, forme za registraciju, hendlanje submita forme - kreiranje novog korisnika, upotreba `bcrypt($request->get('password'))` ili `Hash::make($request->get('password'))` za heširanje passworda, logovanje novokreiranog usera upotrebom `auth()->login($user)`
- Login - kreiranje forme za login, hendlanje submita forme, upotreba `auth()->attempt(['email' => $request->get('email'), 'password'=>$request->get('password')])` za pokušaj logovanja. Ova funkcija će provjeriti da li u bazi postoji korisnik sa datim emailom, provjeriti da li se password poklapa i, ako da, pozvati `auth()->login($user)`
- Logout - `auth()->logout()`
- Ostale metode iz auth helpera: `auth()->user()` dobavlja trenutno ulogovanog usera koji je poslao request, `auth()->check()` provjerava da li je korisnik ulogovan i vraća true/false....
- Upotreba `auth` i `guest` middlewarea za zabranu ruta ulogovanim/neulogovanim korisnicima. Middleware možemo postaviti na pojedinačne rute, na grupe ruta upotrebom Route::group ili na sve akcije kontrolera pisanjem `$this->middlware('middlewareName')`u konstruktoru kontrolera - https://laravel.com/docs/7.x/middleware
### Dan 6
- SMPT server, mailtrap, postavka slanja mailova upisivanjem podataka u .env fajl https://blog.mailtrap.io/send-email-in-laravel/#How_to_send_email_in_Laravel_70_using_SMTP
- Generisanje Mail klase komandom `php artisan make:mail NazivMaila`, buildanje email poruke - zadavanje subjecta, prosleđivanje viewa (blade templatea), attachovanje fajlova, definisanje from adrese
- Slanje emailova upotrebom `Mail::to($emailAddress/$user/$users)->send(new MailClass)` https://laravel.com/docs/7.x/mail
- Sesija - definisanje session drivera (gdje će laravel čuvati podatke sa sesije - file, database (kreiranje sessions tabele), cookie itd), setovanje podataka na sesiju upotrebom session helpera `session(['key' => 'value'])` ili session metodom nad requestom `$request->session()->put('key', 'value')`; dobavljanje podataka sa sesiije upotrebom `session('key', 'default')` ili `$request->session()->get('key', 'default')` https://laravel.com/docs/7.x/session
