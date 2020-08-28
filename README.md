# wp-bs4seed-theme
Wordpress Theme Seed that uses Bootstrap 4

## Introduction
The objectives of this project are:
- To provide a seed for Wordpress Themes that can jumpstart your development
- To have at hand different tools and scripts such as Gulp tasks, typical Wordpress functions and Sass compilation including Bootstrap

The project considers you will have a development folder with the files on this repository and a webserver with a Wordpress installation in your local computer.

## Installation
1. Go to your local projects' folder and clone seed:
`git clone https://github.com/patogeno/wp-bs4seed-theme.git`

2. Download and install node.js and npm if you have not done it yet.
[Get npm.](https://www.npmjs.com/get-npm)

3. Run `npm install`. This will install all dependencies inside node_modules folder.

4. Run `npm run config`. This script will ask you for the slug name of your theme and the folder location where your compiled theme will be copied.

Ready to go! Start coding.

## Folder Structure of Theme
```
bs4seed            # root theme folder
├── assets
│   ├── fonts
│   ├── images
│   ├── js
│   ├── php
│   ├── css        # contains compiled styles in built theme
│   └── sass       # not part of built theme
├── style.css
├── functions.php
└── index.php
└── ...            # templates and screenshot.png
```

## Interesting Code
### Configuration with prompted questions
Check [config.js](config.js) that contains a script to ask and modify variables inside [config.json](config.json)  
[config.json](config.json) is expected to contain important configuration variables. For now, it only holds your theme slug and server folder. These are used in [gulpfile.js](gulpfile.js).

### Gulp tasks
Gulp is great to automate tasks. The tasks currently programmed are:
- **imageminTask** minimises jpg, png and svg files inside [Asset Images folder](bs4seed/assets/images/)
- **imageOptimiser** optimises images that are copied inside [image-optimiser](image-optimiser/in/)
- **sassTask** compiles [Sass files](bs4seed/assets/sass/) to main.css into CSS assets folder
- **mainVersionUpdate** updates the style cache number inside [functions.php](bs4seed/functions.php) to ensure CSS file is reloaded by browsers when updated.
- **uglifyTask** merges and minimises Javascript files inside [Asset js folder]((bs4seed/assets/js/))
- **rootFiles** copies modified files in the [root folder](bs4seed/) 
- **additionalAssets** copies modified files of other assets such as fonts and php files

### Wordpress Customizer
Check [customizer.php](bs4seed/assets/php/customizer.php) to learn how to add sections, settings and controls in the Customizer section to define your own modifications in your theme.  
In addition, [utilities.php](bs4seed/assets/php/utilities.php) provides a function to define a default value when theme_mod from Customizer is requested.

### Menu Name as Title
[utilities.php](bs4seed/assets/php/utilities.php) has a function to get a menu name from a location. It is used in this them to show as menu title in the footer.  
Thanks [Gayan Priyadarshana/codemixin](https://github.com/gayankd/) to provide the code in [stackoverflow](https://stackoverflow.com/questions/32647965/how-to-display-the-menu-name-of-a-menu-in-wordpress).