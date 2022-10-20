# Scss

Module to compile CSS from SCSS

## Watch core files

When working on PRs for the ProcessWire backend you'll notice that the core ships with several SCSS files and the corresponding CSS files. To make it easy to work on the SCSS files without the need of adding complicated build tools to your project you can simply install the Scss module and add the following in `/site/ready.php`

```php
$modules->get('Scss')->watchCore();
```

Now your SCSS files will be watched for changes and once you change something and reload your page you'll get the new CSS on the fly and can commit both changes 😎
