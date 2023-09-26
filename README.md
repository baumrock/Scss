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
