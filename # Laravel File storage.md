# Laravel File storage
Docs: [https://laravel.com/docs/7.x/filesystem]

## Add cover image to Posts migrartion (If not there)

If not already there, start by adding to the posts table a column to store the cover image.

```bash
php artisan make:migration add_cover_to_posts_table
```

edit the migration

```php
$table->string('cover')->after('id')->nullable();
```

run the migration

```bash
php artisan migrate
```

## Add input:files to the create posts form

```html

<div class="form-group">
    <label for="cover">Cover Image</label>
    <input type="file" class="form-control-file" name="cover" id="cover" placeholder="Add a cover image" aria-describedby="coverImgHelper">
    <small id="coverImgHelper" class="form-text text-muted">Add a cover image</small>
</div>
@error('cover')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
```

## Add enctype attribute to the form

https://www.w3schools.com/tags/att_form_enctype.asp

```html
    <form action="{{route('admin.posts.store')}}" method="post" enctype="multipart/form-data">
```

## DDD the request from the Admin/PostController@store method

Let's see if we have everything from the request.

```php
ddd($request->all())
```

## Validate the file request

We need to validate the file, we can do so using one of the Laravel's validation rules

```php
$validatedData = $request->validate([
           'title' => 'required',
           'body' => 'required',
           'cover' => 'nullable | image | max:500'
        ]);
```

## Put the file in the storage

save the file and redirect

```php
public function store(Request $request)
{
        
  
  //dd($request->all());
  
  // validare i dati
  $validatedData = $request->validate([
      'title' => 'required',
      'body' => 'required',   
      'cover' => 'nullable | image | max:500',
      ]);
      
  $cover = Storage::disk('public')->put('posts_img', $request->cover);
  $validatedData['cover'] = $cover;

  //dd($validatedData);
  $post = Post::create($validatedData);
  
  return redirect()->route('admin.posts.show', $post->id);
}
```

## Run storage link

To make things work remember to run the storage:link command

```bash
php artisan storage:link
```

## show the image

Now we can use assets to show the image

```html
 @if($post->cover)
        <img src="{{asset('storage/' . $post->cover )}}" alt="">
    @endif
```
