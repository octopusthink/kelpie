# Kelpie

A system-oriented and block editor-friendly starter theme for WordPress. Alternatively: [Scottish water-horse spirits](https://en.wikipedia.org/wiki/Kelpie). 🦄

Kelpie is designed for agency-types building custom WordPress themes for clients. If you're looking to build a theme to distribute more widely, this may not be the right choice for you.

Kelpie aims to avoid the whack-a-mole process of building WordPress themes by relying heavily on design tokens and mixins, scoping styles tightly to individual components rather than creating a lot of broad global style rules.

This is very much an experiment-in-progress. If you're interested in using Kelpie for your own projects, do feel free, but keep in mind that it is extremely experimental at the moment.

## Building a site with Kelpie

### Getting started

1. Download a copy of Kelpie from this repo using the "Clone" button.
2. Remove any *.lock files. (Eventually, we'll make a package available!)
3. Rename any files with "kelpie" in the name to your theme's namespace. (This should be the main theme folder, plus the classes files in /classes.)
4. Run a find-and-replace to get all instances of "Kelpie" and "kelpie" (case-sensitive!) with your theme name.
5. Find-and-replace 'octopusthink' with your organisation's GitHub organisation.

Eventually, the steps above will be replaced by some sort of automated system, but for the time being, we just aren't that fancy.

### Installing dependencies

You'll need to have [npm](https://www.npmjs.com/get-npm) and [composer](https://getcomposer.org/download/) installed in order to compile CSS & JS and lint PHP, respectively. npm is required, composer is optional

1. Run `npm install` and `composer install` .
2. Replace metadata at top of style.scss
3. Replace metadata in composer.json and package.json
4. Run `npm start` to compile & watch SCSS files.

### Using design tokens

Kelpie takes a design-systems-oriented approach to WordPress themeing, meaning that it distills visual decisions into design tokens and applies them semantically to elements across the site. This means that it's relatively easy to change the look and feel of a site quite quickly by changing a few lines of code. You'll want to start with `abstract/variables.scss`, where you'll find all your site tokens.

**Typography:** Kelpie comes with a mobile and a desktop type scale, each with a configurable base size and scale modifier. Typographic rules for different font classes can be set directly in the variables file.

Make sure to load your font files (if you're using webfonts) in your `functions.php` by loading them using the commented-out functions: `wp_enqueue_style( 'kelpie-fonts', '[URL]', array(), '1.0' );`

Once your sizes are properly determined in your theme, you'll want to make sure you make them available in the editor as well by editing the `'editor-font-sizes'` section of `functions.php`. These sizes should match the sizes your type scale outputs.

**Spacing:** Kelpie uses an 8px grid for a harmonious vertical rhythm. It provides an assortment of sizing units from "hairline" (4px) to "xxl" (128px) to provide a consistent way of spacing components. Generally speaking, you won't want to change these all that much, although if you have a theme that calls for lots of whitespace, you may want to bump all the numbers.

Kelpie also has a number of site-wide variables, such as max content width, max site width, overall padding, etc, that are used to keep consistent proportions across elements. These can be tweaked as appropriate for your typography. Finally, it also comes with a set of breakpoints that can easily be accessed via a `@include media('breakpoint-name')` mixin.

**Colours:** Kelpie has a neutral palette, composed of white-to-black shades. This is good for body copy, borders, backgrounds, and other elements that don't require high prominence. It also allows for two palettes of accent colours, used for links, buttons, and highlights—anything that warrants more attention. Providing tints and hues of these accent colours allows for better hover effects and more accessible colour combinations.

These colours are then applied to elements semantically using further variables, and can be applied to further elements in your theme semantically or using their named value.

Once your colours are set in your theme, be sure to make them available in the editor so that people can use them. `'editor-color-palette'` in `functions.php` will allow you to define these colour variables to match the base variables in your theme. Once that's done, Kelpie will output colour classes automically, so users will automatically be able to apply your colours to blocks.

If you need to change the output of colour classes, you can do so by modifying `/blocks/_colors.scss`

**Other SCSS files:**
`abstracts/mixins`: Reusable style classes that can be applied to multiple elements.
`blocks`: Editor blocks & styles.
`components`: Modular components (that aren't editor blocks, at least for now.)
`editor-only`: Styles that only apply to the editor context.
`layout`: Template & layout blocks.

## Local Development

Once you've set up a local development environment, you're ready to start working on the code. You'll want to start by installing dependencies:

```bash
npm install
```

Then, to watch and build SCSS files, start the script:

```bash
npm start
```

Any changes you make to files in the `scss` folder will automatically be compiled. It's best to avoid making changes to `style.css` directly and instead modifying the source `.scss` files.

Before pushing changes to production, run the build script:

```bash
npm run build
```

## Linting SCSS Files

To keep SCSS sources consistent and readable, we use stylelint. To check that your styles pass the linter, run:

```bash
npm run stylelint
```

Most issues can be fixed automatically:

```bash
npm run stylelint:fix
```

Rules for the style linter follow a combination of best practises and WordPress conventions. See `.stylelintrc` for details.

## Run PHP CodeSniffer

To ensure PHP is meeting the [WordPress Coding Standards](https://make.wordpress.org/core/handbook/best-practices/coding-standards/), install [composer](https://getcomposer.org/) on your machine and run `composer install` to install the dependencies needed for the linter. Then run:

```bash
composer lint
```

to ensure your PHP code matches the expected code standards.

You can often have the script magically fix any simple errors by running lint-fix:

```bash
composer lint-fix
```

## Contributing

Please read (`CONTRIBUTING.md`) for details on our code of conduct and the process for submitting pull requests.

We use the [Conventional Commits](https://www.conventionalcommits.org/) specification for commit messages to ensure that commit messages are written in a consistent and predictable way.

## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [releases page](https://github.com/octopusthink/kelpie/releases).

## Authors

- **sarah semark** - _CDO (Chief Design Octopus)_ - [@sarahmonster](https://github.com/sarahmonster)
- **Matthew Riley MacPherson** - _CTO (Chief Technical Octopus)_ - [@tofumatt](https://github.com/tofumatt)

See also the list of [contributors](https://github.com/octopusthink/kelpie/contributors) who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE.txt](https://github.com/octopusthink/kelpie/blob/master/LICENSE.txt) file for details.

## Acknowledgments

Kelpie borrows and steals from all sorts of sources, namely:

- [\_s](https://github.com/Automattic/_s)
- [Gutenberg Starter Theme](https://github.com/WordPress/gutenberg-starter-theme)
- [Twenty Twenty](https://wordpress.org/themes/twentytwenty/)
- [Varia](https://github.com/Automattic/themes/blob/master/varia)
