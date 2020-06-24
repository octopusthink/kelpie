# Kelpie

A block editor-friendly starter theme for WordPress. Alternatively: [Scottish water-horse spirits](https://en.wikipedia.org/wiki/Kelpie). 🦄

Kelpie is designed for agency-types building custom WordPress themes for clients. If you're looking to build a theme to distribute more widely, this may not be the right choice for you.

Kelpie aims to avoid the whack-a-mole process of building WordPress themes by relying heavily on design tokens and mixins, scoping styles tightly to individual components rather than creating a lot of broad global style rules.

This is very much an experiment-in-progress. If you're interested in using Kelpie for your own projects, do feel free, but keep in mind that it is extremely experimental at the moment.

## Getting Started

1. Copy all files except the following: *.lock  etc etc
2. Un-ignore
3. Run a find-and-replace to get all instances of "Kelpie" and "kelpie" (case-sensitive!)
4. Find-and-replace 'octopusthink' with 'a8cteam51'.
5. Make sure to change the files names as well (in classes dir)
6. Run `npm install` and `composer install` .
7. Replace metadata at top of style.scss
8. Replace metadata in composer.json and package.json


9.  Have at it! I always start by swapping out colours, then typography. Make sure to change functions.php to reflect your final colours & font sizes!


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
