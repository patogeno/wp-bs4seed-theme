const rls = require("readline-sync")
const fs = require("fs")
const os = require("os")

const DEFAULT_THEME_SLUG = "bs4seed"
const DEFAULT_THEME_SERVER_FOLDER = "C:/wamp64/www/wordpress/wp-content/themes/"
const ENV_FILE = ".env"

/** FIRST QUESTION: THEME SLUG **/
const maxRetries = 5;
let themeSlug = null;

// Loop to repeat question until slug is correct or maximum retries is reached
for (let i=0; i<maxRetries; i++) {
    if (i==0) {
        themeSlug = rls.question(`The theme slug is used as folder name for your theme and general reference.${os.EOL}\
It must only contain letters (lowercase), numbers and dashes (no special characters or spaces).${os.EOL}\
What is the theme slug? (${DEFAULT_THEME_SLUG}) `)
    } else {
        themeSlug = rls.question("Slug is not valid. Please try again: ")
    }
    // Trim answer
    themeSlug = themeSlug.trim()

    // Default Slug if there is no answer
    if(themeSlug.length == 0)  {
        themeSlug = DEFAULT_THEME_SLUG
        break
    }
    // Validate Slug
    else if(/^[a-z0-9]+(?:-[a-z0-9]+)*$/.test(themeSlug)) {
        break
    } else {
        themeSlug = null
    }
}
// Check if maximum retries were reached or slug was correctly defined.
if (themeSlug == null) {
    console.log("You have reached the maximum number of retries to choose a slug. Good bye!")
    return
} else {
    console.log(`Theme Slug: ${themeSlug}`)
}

/** SECOND QUESTION: THEME SERVER FOLDER **/
let themeServerFolder = rls.question(`What is the folder where your compiled theme will be copied to? (${DEFAULT_THEME_SERVER_FOLDER}) `)
// Trim answer
themeServerFolder = themeServerFolder.trim()

// Default Theme Server Folder if there is no answer
if (themeServerFolder.length == 0) {
    themeServerFolder = DEFAULT_THEME_SERVER_FOLDER
}
console.log(`Theme Server Folder: ${themeServerFolder}`)

/** WRITE CONFIG FILE **/
let previousThemeSlug;
fs.readFile(ENV_FILE, 'utf8', function (err,data) {
    // if file does not exist, create file with selected parameters
    if (err) {
        const textToWrite = `THEME_SLUG=${themeSlug}${os.EOL}THEME_SERVER_FOLDER="${themeServerFolder}"${os.EOL}`
        // Write new file
        fs.writeFile(ENV_FILE, textToWrite, 'utf8', function (err) {if (err) throw err});
        previousThemeSlug = DEFAULT_THEME_SLUG
        console.log(`File ${ENV_FILE} has been created.`)
    }
    // If file exists, update configuration
    else {
        previousThemeSlug = data.match(/THEME_SLUG\s*=\s*(.*)/)[1]
        let result = data.replace(/THEME_SLUG\s*=\s*.*/g, `THEME_SLUG=${themeSlug}`)
        result = result.replace(/THEME_SERVER_FOLDER\s*=\s*".*"/g, `THEME_SERVER_FOLDER="${themeServerFolder}"`)
    
        // Update file
        fs.writeFile(ENV_FILE, result, 'utf8', function (err) {if (err) throw err})

        console.log(`File ${ENV_FILE} has been updated.`)
    }
    
    /* RENAME THEME FOLDER */
    fs.rename(`./${previousThemeSlug}`, `./${themeSlug}`, function(err) {
        if (err) throw err
        else console.log("Theme Folder was successfully renamed as per selected slug.")
    })            
})
