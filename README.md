# Kelpie

A block editor-friendly starter theme for WordPress. Alternatively: [Scottish water-horse spirits](https://en.wikipedia.org/wiki/Kelpie). 🦄

Kelpie is designed for agency-types building custom WordPress themes for clients. If you're looking to build a theme to distribute more widely, this may not be the right choice for you.

Kelpie aims to avoid the whack-a-mole process of building WordPress themes by relying heavily on design tokens and mixins, scoping styles tightly to individual components rather than creating a lot of broad global style rules.

This is very much an experiment-in-progress. If you're interested in using Kelpie for your own projects, do feel free, but keep in mind that it is extremely experimental at the moment.

## Getting Started

### Get your files in order

1. Download a copy of Kelpie from this repo using the "Clone" button. 
2. Remove any *.lock files. (Eventually, we'll make a package available!)
3. Rename any files with "kelpie" in the name to your theme's namespace. (This should be the main theme folder, plus the classes files in /classes.)
4. Run a find-and-replace to get all instances of "Kelpie" and "kelpie" (case-sensitive!) with your theme name.
5. Find-and-replace 'octopusthink' with your organisation's GitHub organisation.

Eventually, the steps above will be replaced by some sort of automated system, but for the time being, we just aren't that fancy.

### Install dependencies and get started!

1. Run `npm install` and `composer install` .
2. Replace metadata at top of style.scss
3. Replace metadata in composer.json and package.json
4. Run `npm start` to compile & watch SCSS files.

### Start customising!

Kelpie really aims to be as design-system-oriented as possible, meaning you can make a lot of progress just by changing a few variables. Here's what we recommend starting with:
1. Open `abstract/variables.scss`. Here you'll find all your site variables.
2. Start by swapping out the colours. Kelpie want you to have a primary palette composed of white-to-black shades, good for typography, borders, backgrounds, and other stuff you don't need to have high prominence. It also allows for two palettes of accent colours, used for links, buttons, and highlights—anything that warrants more attention. Providing a full range of white to black allows for more colour combinations. 

You can then call these colours anywhere in your theme using their semantic names.

Finally, you'll want to make these colours available in the editor, so that people can use them. Open up your functions.php and scroll down to // Editor colour palette, where you'll find the colours defined. You'll need to define these colour variables to match the base variables in your theme. Once that's done, Kelpie will output colour classes automically, so users will automatically be able to apply your colours to elements in the layout. 

If you need to change the output of colour classes, you can do so by modifying `/editor-styles/_colors.scss`

Set up typography

First, you'll want to load fonts into your theme, assuming you're using webfonts. There's a function provided for this in functions.php again.

Use the following bit of code:

// enqueue web fonts
wp_enqueue_style( 'kelpie-fonts', '[URL]', array(), '1.0' );

Then, change your typography variables in variables.scss to refer to the correct typefaces.

How the type scale works


## Set your content width

Content width:

this is the max-width applied to site content—paragraphs, images, etc. It should be set based on your typography for optimal line lengths.

Set 'max-content-width': in variables
$GLOBALS['content_width'] in functions.php




3. Have at it! I always start by swapping out colours, then typography. Make sure to change functions.php to reflect your final colours & font sizes!


TODO:

- use consistent sizing for t-shirt variables! m or medium!
- update README
- clean up menu output
- apply social menu styling in widget!
- base styling for widget areas as well as kelpie-page-content
- move branding scss into own sass file

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
