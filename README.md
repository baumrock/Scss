# Scss

Module to compile CSS from SCSS, using https://github.com/scssphp/scssphp

## Auto-compile CSS from SCSS when a file changed

You can put this code into `/site/ready.php` to automatically recompile an input file (SCSS) into an output file (CSS) whenever one of the watched files changed:

```php
/** @var Scss $scss */
$scss = $modules->get('Scss');

// Find all files with .scss extension in /site/templates/scss.
// You can adjust that to your needs! Note that this might impact your
// websites performance. Usually $files->find() is very fast, but the more files
// you scan, the slower it will get - so try to be specific with your find().
// Also see https://github.com/processwire/processwire-issues/issues/1791
$watchFiles = $files->find(
  $config->paths->templates . "scss",
  ['extensions' => 'scss']
);

// compile input SCSS to output CSS
$scss->compileIfChanged(
  input: $config->paths->templates . "scss/example.scss",
  watch: $watchFiles,

  // you can optionally define a custom output path
  // if not defined it will use the input path and replace .scss with .css
  // output: '/foo/bar/baz.css',

  // by default the output will be minified, use 'compressed' or 'expanded'
  // style: 'compressed',
);
```

## Watch core files

When working on PRs for the ProcessWire backend you'll notice that the core ships with several SCSS files and the corresponding CSS files. To make it easy to work on the SCSS files without the need of adding complicated build tools to your project you can simply install the Scss module and add the following in `/site/ready.php`

```php
$modules->get('Scss')->watchCore();
```

Now your SCSS files will be watched for changes and once you change something and reload your page you'll get the new CSS on the fly and can commit both changes 😎

## Compile UIkit

```php
// for development you can put this in site/ready.php

/** @var Scss $scss */
$scss = $this->wire->modules->get('Scss');

// also watch all files in /site/templates/scss
$watchFiles = $files->find(
  $config->paths->templates . "scss",
  ['extensions' => 'scss']
);

// set the import path so that relative @import statements work
$scss->compiler()->setImportPaths($config->paths->templates);

// compile SCSS to CSS if any of the watched files changed
$scss->compileIfChanged(
  // create this file with the content from the uikit docs:
  // https://getuikit.com/docs/sass#how-to-build
  input: $config->paths->templates . "scss/uikit.scss",
  watch: $watchFiles,
  output: $config->paths->templates . "scss/uikit.css",
  style: 'compressed',
);
```

# Scss

Module to compile CSS from SCSS, using https://github.com/scssphp/scssphp

## Auto-compile CSS from SCSS when a file changed

You can put this code into `/site/ready.php` to automatically recompile an input file (SCSS) into an output file (CSS) whenever one of the watched files changed:

```php
/** @var Scss $scss */
$scss = $modules->get('Scss');

// Find all files with .scss extension in /site/templates/scss.
// You can adjust that to your needs! Note that this might impact your
// websites performance. Usually $files->find() is very fast, but the more files
// you scan, the slower it will get - so try to be specific with your find().
// Also see https://github.com/processwire/processwire-issues/issues/1791
$watchFiles = $files->find(
  $config->paths->templates . "scss",
  ['extensions' => 'scss']
);

// compile input SCSS to output CSS
$scss->compileIfChanged(
  input: $config->paths->templates . "scss/example.scss",
  watch: $watchFiles,

  // you can optionally define a custom output path
  // if not defined it will use the input path and replace .scss with .css
  // output: '/foo/bar/baz.css',

  // by default the output will be minified, use 'compressed' or 'expanded'
  // style: 'compressed',
);
```

## Watch core files

When working on PRs for the ProcessWire backend you'll notice that the core ships with several SCSS files and the corresponding CSS files. To make it easy to work on the SCSS files without the need of adding complicated build tools to your project you can simply install the Scss module and add the following in `/site/ready.php`

```php
$modules->get('Scss')->watchCore();
```

Now your SCSS files will be watched for changes and once you change something and reload your page you'll get the new CSS on the fly and can commit both changes 😎

## Compile UIkit

```php
// for development you can put this in site/ready.php

/** @var Scss $scss */
$scss = $this->wire->modules->get('Scss');

// also watch all files in /site/templates/scss
$watchFiles = $files->find(
  $config->paths->templates . "scss",
  ['extensions' => 'scss']
);

// set the import path so that relative @import statements work
$scss->compiler()->setImportPaths($config->paths->templates);

// compile SCSS to CSS if any of the watched files changed
$scss->compileIfChanged(
  // create this file with the content from the uikit docs:
  // https://getuikit.com/docs/sass#how-to-build
  input: $config->paths->templates . "scss/uikit.scss",
  watch: $watchFiles,
  output: $config->paths->templates . "scss/uikit.css",
  style: 'compressed',
);
```

## Compile Bootstrap

- Download bootstrap source files to `/site/templates/bootstrap`
- Create the file `/site/templates/bs/theme.scss`

In theme.css place this:

```scss
@import "bootstrap";
// customisations go here
```

In `/site/ready.php` add this:

```php
/** @var Scss $scss */
$scss = $this->wire->modules->get('Scss');

// watch all files in /site/templates/scss
$watchFiles = $files->find(
  $config->paths->templates . "bs",
  ['extensions' => 'scss']
);

// set the import path so that relative @import statements work
$scss->compiler()->setImportPaths($config->paths->templates . "bootstrap/scss");

// compile SCSS to CSS if any of the watched files changed
$scss->compileIfChanged(
  // create this file with the content from the uikit docs:
  // https://getuikit.com/docs/sass#how-to-build
  input: $config->paths->templates . "bs/theme.scss",
  watch: $watchFiles,
  output: $config->paths->templates . "bootstrap.css",
  style: 'compressed',
);
```
