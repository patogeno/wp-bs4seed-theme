const rls = require("readline-sync");
const fs = require("fs");

const DEFAULT_THEME_SLUG = "bs4seed";
const DEFAULT_THEME_SERVER_FOLDER = "C:/wamp64/www/wordpress/wp-content/themes/";
const CONFIG_FILE = "config.json";

/* FIRST QUESTION: THEME SLUG */
const maxRetries = 5;
let themeSlug = null;
for (let i=0; i<maxRetries; i++) {
    if (i==0) {
        themeSlug = rls.question("The theme slug is used as folder name for your theme and general reference.\n\
It must only contain letters (lowercase), numbers and dashes (no special characters or spaces).\n\
What is the theme slug? (" + DEFAULT_THEME_SLUG + ") ");
    } else {
        themeSlug = rls.question("Slug is not valid. Please try again: ");
    }
    themeSlug = themeSlug.trim();

    // Default Slug
    if(themeSlug.length == 0)  {
        themeSlug = DEFAULT_THEME_SLUG;
        break;
    }
    // Validate Slug
    else if(/^[a-z0-9]+(?:-[a-z0-9]+)*$/.test(themeSlug)) {
        break;
    } else {
        themeSlug = null;
    }
}
if (themeSlug == null) {
    console.log("You have reached the maximum number of retries to choose a slug. Good bye!");
} else {
    console.log("Theme Slug: " + themeSlug);
}

/* SECOND QUESTION: THEME SERVER FOLDER */
let themeServerFolder = rls.question("What is the folder where your compiled theme will be copied to? (" + DEFAULT_THEME_SERVER_FOLDER + ") ");
themeServerFolder = themeServerFolder.trim();

// Default Theme Server Folder
if (themeServerFolder.length == 0) {
    themeServerFolder = DEFAULT_THEME_SERVER_FOLDER;
}
console.log("Theme Server Folder: " + themeServerFolder);

/* WRITE CONFIG FILE */
let previousThemeSlug;
fs.readFile(CONFIG_FILE, 'utf8', function (err,data) {
    if (err) {
        return console.log(err);
    }

    previousThemeSlug = data.match(/"themeSlug"\s*:\s*"(.*)"/)[1];
    let result = data.replace(/"themeSlug"\s*:\s*".*"/g, '"themeSlug" : "' + themeSlug + '"');
    result = result.replace(/"themeServerFolder"\s*:\s*".*"/g, '"themeServerFolder" : "' + themeServerFolder + '"');
  
    fs.writeFile(CONFIG_FILE, result, 'utf8', function (err) {
       if (err) return console.log(err);
    });

    console.log(`File ${CONFIG_FILE} has been updated.`);

    /* RENAME THEME FOLDER */
    fs.rename("./" + previousThemeSlug, "./" + themeSlug, function(err) {
        if (err) {
        console.log(err);
        } else {
        console.log("Theme Folder was successfully renamed as per selected slug.");
        }
    })            
});
