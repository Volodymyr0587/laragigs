- ### 01 - Setting Up Laravel 
```composer create-project laravel/laravel laragigs```
        
- ### 02- Routing & Responses 

- ### 03 - Wildcard Endpoints 

- ### 07 - Route Constraints 

 ```
Route::get('/posts/{id}', function($id) {
        return response('Post ' . $id);
    })->where('id', '[0-9]+');
```
 *limit only to numbers from 1 to 9, i.e. 
you can pass in the address bar after
posts only numbers, e.g. http://127.0.0.1:8000/posts/12
And this way http://127.0.0.1:8000/posts/foobar will give an error 404**

---
---
- ### 08 - Die Dump Helpers 
    
    #### Helper functions:
        
```
dd() // Dump & Die 
ddd() // Dump, Die, Debug
```
---
---
- ### 09 - Request & Query Params 

    File: `routes/web.php`

```
Route::get('/search', function(Request $request) {
	return $request->name . ' ' . $request->city;
});
```

If you type in http://127.0.0.1:8000/search?name=Brad&city=Boston
you will get Brad Boston

---
---
- ### 10 - API Routes 

    File: `routes/api.php`
    
```
Route::get('/posts', function() {
	return response()->json([
    	'posts' => [
			[
				'title' => 'Post One'
			]
    ]
    ]);
});
```

You can get this json at 127.0.0.1:8000/api/posts

- ### 11 - View Basics & Passing Data

- ### 12 - Blade Templates & Basic Directives 

- ### 13 - Creating a Basic Model

- ### 14 - Database Setup & Config

- ### 15 - Create Database & User
[Create new user for mysql (optional)](https://gist.github.com/bradtraversy/c831baaad44343cc945e76c2e30927b3)
        
Creaate database: `CREATE DATABASE laragigs;`

---
---
- ### 16 - Creating Database Migrations 
        
`php artisan make:migration create_listings_table`   *// This will create `database/migrations/xxxx_xx_xx_xxxxxx_create_listings_table.php`*
        
 In this file in method `up()` add fields that we need:
        
```
$table->string('title');
$table->string('tags');
$table->string('company');
$table->string('location');
$table->string('email');
$table->string('website');
$table->longText('description');
```

---
---
- ### 17 - Running Migrations 

`php artisan migrate`

---       
---
- ### 18 - Database Seeding
In file `database/seeders/DatabaseSeeder.php` uncomment line  `\App\Models\User::factory(10)->create();` in `run()` method and in terminal run command:
            
 `php artisan db:seed`
    
To refresh database tables **(Rolling back migrations. delete all records in db!!!)** run command:
    
`php artisan migrate:refresh`
                            
To refresh database tables and seed it again run command:
    
`php artisan migrate:refresh --seed`

---
---
- ### 19 - Create an Eloquent Model 

     Delete model `app/Models/Listing.php`  
     Next create model with artisan:
     
`php artisan make:model Listing` *// Thi will create new model `app/Models/Listing.php`*
    
In file `database/seeders/DatabaseSeeder.php` *// in the run() method add (harcode) the creation of records in the table:*
     
```
Listing::create([
		'title' => 'Laravel Senior Developer',
		'tags' => 'laravel, javascript',
		'company' => 'Acme Corp',
		'location' => 'Boston, MA',
		'email' => 'email1@email.com',
		'website' => 'https://www.acme.com',
		'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam minima et illo reprehenderit quas possimus voluptas repudiandae cum expedita, eveniet aliquid, quam illum quaerat consequatur! Expedita ab consectetur tenetur delensiti?'
	]);

Listing::create([
		'title' => 'Full-Stack Engineer',
		'tags' => 'laravel, backend ,api',
		'company' => 'Stark Industries',
		'location' => 'New York, NY',
		'email' => 'email2@email.com',
		'website' => 'https://www.starkindustries.com',
		'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam minima et illo reprehenderit quas possimus voluptas repudiandae cum expedita, eveniet aliquid, quam illum quaerat consequatur! Expedita ab consectetur tenetur delensiti?'
	]);
```

Running the command `php artisan migrate:refresh --seed`  Fill in the table with data

---
---
- ### 20 - Creating a Factory 

 `php artisan make:factory ListingFactory`
        
  In file `database/factories/ListingFactory.php` add to method `definition()` in class `ListingFactory`
     
```
return [
	'title' => $this->faker->sentence(),
	'tags' => implode(", ", $this->faker->randomElements(['laravel', 'api', 'backend', 'php', 'docker', 'python', 'django', 'java', 'javascript', 'symphony'], 3)),
	'company' => $this->faker->company(),
	'email' => $this->faker->companyEmail(),
	'website' => $this->faker->url(),
	'location' => $this->faker->city(),
	'description' => $this->faker->paragraph(5),
];
```
 In file `database/seeders/DatabaseSeeder.php` In the `run()` method, comment on the creation of entries in the table and add a line `Listing::factory(6)->create();`
Then run command:  `php artisan migrate:refresh --seed`
 
---
---
- ### 21 - Creating a Layout & Sections

- ### 22 - Adding the Theme HTML

- ### 23 - Template Partials 

- ### 24 - Single Listing Formatting

- ### 25 - Route Model Binding
In file `routes/web.php`
     
 ```
// Single Listing
  Route::get('/listings/{listing}', function (Listing $listing) {
	return view('listing', [
		'listing' => $listing
	]);
  });
```
---
---
- ### 26 - Blade Components 

- ### 27 - Component Attributes

- ### 28 - Tags Component 

- ### 29 - Controllers

    `php artisan make:controller ListingController`
    
In file `app/Http/Controllers/ListingController.php`
    
```
class ListingController extends Controller
{
	// Show all listings
	public function index() {
		return view('listings', [
			'listings' => Listing::all()
		]);
	}

	// Show single listing
	public function show(Listing $listing) {
		return view('listing', [
			'listing' => $listing
		]);
	}
}
```
        
In file `routes/web.php`
    
```
// All Listings
Route::get('/', [ListingController::class, 'index']);

// Single Listing
Route::get('/listings/{listing}', [ListingController::class, 'show']);
```

---
---
- ### 30 - Resource Method Naming 

	**Common Resource Routes:**
        
**index** - Show all listings
**show** - Show single listing
**create** - Show Form to create new listing
**store** - Store new listing
**edit** - Show Form to edit listing
**update** - Update listing
**destroy** - Delete listing

---
---
- ### 31 - Using a Layout Component 

- ### 32 - Tag Filter

- ### 33 - Search Filter 

- ### 34 - Clockwork Package

> Clockwork is a development tool for PHP available right in your browser. 
Clockwork gives you an insight into your application runtime - including request data, performance metrics, log entries, database queries, cache queries, redis commands, dispatched events, queued jobs, rendered views and more - for HTTP requests,commands, queue jobs and tests.

**Install Clockwork into project:**
        
`composer require itsgoingd/clockwork`
  
---
---
- ### 35 - Create Listing Form 
                              
**Workflow for adding new functionality:**

1. Create new Route
2. Create new Controller
3. Create new View

1 - In file `routes/web.php` add Show Create Form **BEFORE !!!** Single Listing!

```
// Show Create Form
Route::get('listings/create', [ListingController::class, 'create']);
```

2 -  In file `app/Http/Controllers/ListingController.php`

```
// ShowCreate Form
public function create() {
return view('listings.create');
}
```

3 - Create new file `create.blade.php` (view) in `resources/views/listings/create.blade.php`

In file `resources/views/components/layout.blade.php` add `<a href="/listings/create" class="absolute top-1/3 right-10 bg-black text-white py-2 px-5">Post Job</a>`
    
---
---
- ### 36 - Validation & Store Listing
In file `routes/web.php`
    
```
// Store Listing Data
Route::post('/listings', [ListingController::class, 'store']);
```

In file `app/Http/Controllers/ListingController.php`

```
public function store(Request $request) {
	$formFields = $request->validate([
		'title' => 'required',
		'company' => ['required', Rule::unique('listings', 'company')],
		'location' => 'required',
		'website' => 'required',
		'email' => ['required', 'email'],
		'tags' => 'required',
		'description' => 'required'
]);

Listing::create($formFields);

return redirect('/');
}
```
        
       
All the rules of **VALIDATION** can be found here: [rules](https://laravel.com/docs/10.x/validation#available-validation-rules)

 ---  
 ---
- ## 37 - Mass Assignment Rule

    - #### 1st method:
    In file `app/Models/Listing.php` add property `$fillable` to Listing class:
                
	`protected $fillable = ['title', 'tags', 'company', 'location', 'website', 'email', 'description'];`

	- #### 2nd method:
	
	In file `app/Providers/AppServiceProvider.php` in method `boot` add `Model::unguard()`:
        
```
public function boot(): void
	{
		Model::unguard();
	}
```
        
---   
- ### 38 - Flash Messages

- ### 39 - Alpine.js For Message Removal 

     Add to `layout.blade.php` from [alpinejs.dev](https://alpinejs.dev):
     
	`<script src="//unpkg.com/alpinejs" defer></script>`
        
     and at the bottom before closing tag `</body>` add `<x-flash-message />`
        
     In file `resources/views/components/flash-message.blade.php`
     
```
@if (session()->has('message'))
	<div x-data="{show: true}"
		x-init="setTimeout(() => show = false, 4000)"
		x-show="show"
		class="fixed top-0 left-1/2 transform -translate-x-1/2 bg-laravel text-white px-48 py-3">
		<p>
			{{ session('message') }}
		</p>
	</div>
@endif
```
---
---
- ### 40 - Keep Old Data In Form

    In file `resources/views/listings/create.blade.php`
    
	In each input tag add `value="{{ old('company') }}"`, where **'company'** is the **'name'** attribute.
For example: 

```
<input type="text" class="border border-gray-200 rounded p-2 w-full" name="company" value="{{ old('company') }}" />
```

   In **textarea** between tags:

```
<textarea class="border border-gray-200 rounded p-2 w-full" name="description" rows="10"
placeholder="Include tasks, requirements, salary, etc">{{ old('description') }}</textarea>
```
---
---
- ### 41 - Pagination 
        
    In file `app/Http/Controllers/ListingController.php`
    
	In method `index()` replace `->get()` to `->paginate(4)` *// 4 - number of listing per page. May be different. This will show links to pages (< 1 2 3 >). If use a SimplePaginate instead of paginate, only Previous and Next will be displayed.*
        
    Then in file `resources/views/listings/index.blade.php`
    
```
<div class="mt-6 p-4">
	{{ $listings->links() }}
</div>
```
        
  To change style of pagination need to publish it:
    
`php artisan vendor:publish`
        
 Choose `PaginationServicePovider`. It gives `resources/views/vendor/pagination` directory.
 
 ---
 ---
- ### 42 - File Upload 

    In file `resources/views/listings/create.blade.php`
    
Add field to form:

```
<div class="mb-6">
	<label for="logo" class="inline-block text-lg mb-2">
		Company Logo
	</label>
	<input type="file" class="border border-gray-200 rounded p-2 w-full" name="logo" />

@error('logo')
	<p class="text-red-500 text-xs mt-1">{{ $message }}</p>
@enderror
</div>
```

Add attribute `enctypy="multipart/form-data"` to form:

`<form method="POST" action="/listings" enctype="multipart/form-data">`
            
Then in file `config/filesystems.php`

Change `local` to `public`:
```
'default' => env('FILESYSTEM_DISK', 'public'),
```
To store logo(file) in database create field in migration file 
`database/migrations/xxxx_xx_xx_xxxxxx_create_listings_table.php` add to `up()` method:
```
$table->string('logo')->nullable();  // can be null if not file upload
```
Then run migrations with seed to change database schema and seed new data
(To save previous data run `php artisan migrate:fresh --seed`):

`php artisan migrate:refresh --seed`

Then in file `app/Http/Controllers/ListingController.php` in method store:

...
```
'description' => 'required'
]);

// check if file exist and store to storage/app/public/logos foleder

if($request->hasFile('logo')) {
	$formFields['logo'] = $request->file('logo')->store('logos', 'public');
}
```
...

Now create a simlink from the `storage/app/public` folder to `public` folder:

`php artisan storage:link`

Then, to display the image on the main page and the description page, do the following:

In file `resources/views/components/listing-card.blade.php`
```
<img class="hidden w-48 mr-6 md:block" src="{{ $listing->logo ? asset('storage/' . $listing->logo) : asset('/images/no-image.png') }}" alt="" />
```
In file `resources/views/listings/show.blade.php`
```
 <img class="w-48 mr-6 mb-6" src="{{ $listing->logo ? asset('storage/' . $listing->logo) : asset('/images/no-image.png') }}" alt="" />
```             
---
---
- ### 43 - Edit Listing

    In routes file `routes/web.php`
     
```
// Show Edit Form
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit']);
```
        
   Then in file `resources/views/listings/show.blade.php`
    
 ```
...
</x-card>

<x-card class="mt-4 p-2 flex space-x-6">
	<a href="/listings/{{ $listing->id }}/edit">
		<i class="fa-solid fa-pencil"></i> Edit
	</a>
</x-card>
...
```
        
   Then in file `app/Http/Controllers/ListingController.php`
    
```
// Show Edit Form
public function edit(Listing $listing) {
	return view('listings.edit', [
		'listing' => $listing
	]);
}
```
        
   Then create new file `resources/views/listings/edit.blade.php`
    
   Paste code from `resources/views/listings/create.blade.php`
        
```
...
<form method="POST" action="/listings/{{ $listing->id }}" enctype="multipart/form-data">
	@csrf
	@method('PUT');
...
```
    
   Change `{{ old('title') }}` to `{{ $listing->title }}` Do this with all fields.
        
   Then in file `routes/web.php`
    
```
// Show Edit Form
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit']);

// Update Listing
Route::put('/listings/{listing}', [ListingController::class, 'update']);
```

        
- ### 44 - Delete Listing 

    In file `resources/views/listings/show.blade.php` under Edit link in `x-card`:
    
```
<form method="POST" action="/listings/{{ $listing->id }}">
	@csrf
	@method('DELETE')
	<button class="text-red-500"><i class="fa-solid fa-trash"></i>Delete</button>
</form>
```
        
  Then in file `routes/web.php`
    
```
// Delete Listing
Route::delete('/listings/{listing}', [ListingController::class, 'destroy']);
```
        
   Then in file `app/Http/Controllers/ListingController.php`
    
```
public function destroy(Listing $listing) {
	$listing->delete();
	return redirect('/')->with('message', 'Listing Deleted Successfully.');
}
```

---
---
- ### 45 - User Registration
    
	In file `routes/web.php`

```
// Show Register/Creatte Form
Route::get('/register', [UserController::class, 'create']);
```

Then run command:
        
`php artisan make:controller UserController`
        
Then in file `resources/views/components/layout.blade.php` change link to Register:
    
`<a href="/register" ...`

And `<a href="/login" ...`
        
 Then in file `app/Http/Controllers/UserController.php` add method `create` to class `UserController`:
    
```
// Show  Register/Create Form
public function create() {
	return view('users.register');
}
```
    
    
 Then create folder `resources/views/users` and file `resources/views/users/register.blade.php`
    
 Then in `routes/web.php`
    
```
// Crete New User
Route::post('/users', [UserController::class, 'store']);
```
        
 Then in `app/Http/Controllers/UserController.php` add method `store`:
    
```
// Create New User
public function store(Request $request) {
	$formFields = $request->validate([
		'name' => ['required', 'min:3'],
		'email' => ['required', 'email', Rule::unique('users', 'email')],
		'password' => ['required', 'confirmed', 'min:6'] // 'required|confirmed|min:6'
	]);

	// Hash Password
	$formFields['password'] = bcrypt($formFields['password']);

	// Create User
	$user = User::create($formFields);

	// Login
	auth()->login($user);

	return redirect('/')->with('message', 'User Created and Logged In');
}
```
        
**Test:**

name: John Doe
email: john87@gmail.com
password: password123

name: David
email: david@gmail.com
password: password777

---
---
- ### 46 - Auth Links
 
    Use derective `@auth` 
    In file `resources/views/components/layout.blade.php`
        
```
<ul class="flex space-x-6 mr-6 text-lg">
	@auth
		<li>
			<span class="font-bold uppercase">
				Welcome {{ auth()->user()->name }}
			</span>
		</li>
		<li>
			<a href="/listings/manage" class="hover:text-laravel"><i class="fa-solid fa-gear"></i>Manage Listings</a>
		</li>
	@else
		<li>
			<a href="/register" class="hover:text-laravel"><i class="fa-solid fa-user-plus"></i> Register</a>
		</li>
		<li>
			<a href="/login" class="hover:text-laravel"><i class="fa-solid fa-arrow-right-to-bracket"></i>
		Login</a>
		</li>
	@endauth
</ul>
```

---
---
- ### 47 - User Logout 

    [Documentation](https://laravel.com/docs/10.x/authentication#logging-out)
    
    In file `resources/views/components/layout.blade.php`
    
```
<li>
	<form class="inline" method="POST" action="/logout">
		@csrf
		<button type="submit">
			<i class="fa-solid fa-door-closed"></i> Logout
		</button>
	</form>
</li>
```
        
Then in file `routes/web.php`
    
`Route::get('/logout', [UserController::class, 'logout']);`
        
Then in file `app/Http/Controllers/UserController.php` add method `logout` to class:
    
```
// Logout User
public function logout(Request $request) {
	auth()->logout();

	$request->session()->invalidate();

	$request->session()->regenerateToken();

	return redirect('/')->with('message', 'You Have Been Logged Out');
}
```

---
---
- ### 48 - User Login 
    
     In file `routes/web.php`
        
```
// Show Login Form
Route::get('/login', [UserController::class, 'login']);
```
        
   In file `app/Http/Controllers/UserController.php`
     
```
// Show Login Form
public function login() {
	return view('users.login');
}
```
        
   Create view `resources/views/users/login.blade.php` (copy `register.blade.php`)
        
   Then in file `routes/web.php`
     
```
// Log User In
Route::post('/users/authenticate', [UserController::class, 'authenticate']);
```
        
   Then in file `app/Http/Controllers/UserController.php` create method '`authenticate`'
        
```
// Authenticate User
public function authenticate(Request $request) {
	$formFields = $request->validate([
		'email' => ['required', 'email'],
		'password' => ['required']
	]);

	if (Auth::attempt($formFields)) {
		$request->session()->regenerate();

		return redirect('/')->with('message', 'You Are Now Logged In!');
	}

	return back()->withErrors([
		'email' => 'The provided credentials do not match our records.',
	])->onlyInput('email');
}
```
        
  ---
  ---
- ### 49 - Auth & Guest Middleware 

    In file `routes/web.php`
    
    Add `->middleware('auth')` to:
        
```
Route::get('listings/create', [ListingController::class, 'create'])->middleware('auth');

Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');

Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');

Route::put('/listings/{listing}', [ListingController::class, 'update'])->middleware('auth');

Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->middleware('auth');

Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');
```
        
   Add `->name('login')` to:
        
```
Route::get('/login', [UserController::class, 'login'])->name('login');
```
            
  Add `->middleware('guest')` to:
        
```
// Show Register/Create Form
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

// Show Login Form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');
```
            
   Logic of `auth` in `app/Http/Middleware/Authenticate.php`
        
 In file `app/Providers/RouteServiceProvider.php`:
    
  Change `'/home'` to `'/'` (because our home page is '/' and not '/home) to prevent an already 
  registered user from going to `/register` in the browser address bar:
        
```
public const HOME = '/';
```

---
---
- ### 50 - Relationships 
    
    In file `database/migrations/xxxx_xx_xx_xxxxxx_create_listings_table.php` add field to database
```
$table->foreignId('user_id')->constrained()->onDelete('cascade');
```  
*// If you delete a user, all records associated with this particular user are deleted.*
        
  Then in file `database/seeders/DatabaseSeeder.php`
    
```
// \App\Models\User::factory(5)->create();

$user = User::factory()->create([
	'name' => 'John Doe',
	'email' => 'john@gmail.com'
]);

Listing::factory(6)->create([
	'user_id' => $user->id
]);
```
        
  Then do migrations:
    
  `php artisan migrate:refresh --seed`    // Do this only on development stage!!! **NOT IN PRODUCTION!!!**
        
Then define the relationship in file `app/Models/Listing.php` (Relationship is `belongsTo` because a `Listing` belongs to `User`)
    
```
// add method `user()` to Listing class

public function user() {
	return $this->belongsTo(User::class, 'user_id');
}
```
        
Then do the same in `app/Models/User.php`
        
```
// add method `listings()` to User class

// Relationship With Listings
public function listings() {
	return $this->hasMany(Listing::class, 'user_id');
}
```
**LISTING BELONGS TO USER AND USER HAS MANY LISTINGS** 

---
---
- ### 51 - Tinker Tinkering 

    Tinker is a command line tool to work with models, create queries, add data to database, etc.
    To run tinker: `php artisan tinker`
    

`\App\Models\Listing::first()`  *// get first record*
  
`\App\Models\Listing::find(3)` *// get specific listing by ID*
        
`\App\Models\Listing::find(3)->user` *// find user*
    
`$user = \App\Models\User::first()` *// get first user to variable $user*
        
`$user->listings` *// get all listings of first user*

---
---
- ### 52 - Add Ownership to Listing 

    Register new user:
    
	**name:** John Doe
	**email:** john@gmail.com
	**password:** password123
        
    In file `app/Http/Controllers/ListingController.php` in Store Listing Data method `store()` add before`Listing::create($formFields);`:
    
```
$formFields['user_id'] = auth()->id();
```
        
---
---
- ### 52-1 - Display 'Edit' and 'Delete' button only owner(author) of record in database

    In file `resources/views/listings/show.blade.php` to display **'Edit'** and **'Delete'**  button only to owner(author) of record in database:
    
```
@if (auth()->id() === $listing->user_id)

	<x-card class="mt-4 p-2 flex space-x-6">
		<a href="/listings/{{ $listing->id }}/edit">
			<i class="fa-solid fa-pencil"></i> Edit
		</a>

		<form method="POST" action="/listings/{{ $listing->id }}">
			@csrf
			@method('DELETE')
			<button class="text-red-500"><i class="fa-solid fa-trash"></i>Delete</button>
		</form>
	</x-card>

@endif
```
        
 ---
 ---
- ### 53 - Manage Listings Page

    In file `routes/web.php`
    
```
// Manage Listings
Route::get('/listings/manage', [ListingController::class, 'manage'])->middleware('auth');
```

   In file `app/Http/Controllers/ListingController.php` add method `manage` to class `ListingController`:
    
```
// Manage Listings
public function manage() {
	return view('listings.manage', ['listings' => auth()->user()->listings()->get()]);
}
```
    
   Then create file `resources/views/listings/manage.blade.php` 

---
---
- ### 54 - User Authorization

    In file `app/Http/Controllers/ListingController.php` 
    
     In methods `update`, `destroy`:
            
```
// Make sure logged in user is owner
if ($listing->user_id != auth()->id()) {
	abort(403, 'Unauthorized Action');
}
```

# END :)
