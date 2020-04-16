# Messenger
Place this app in **nextcloud/apps/**

## Configuration
- As an NextCloud admin go to "Settings -> Administration -> Additional settings"
- Provide the Rocket Chat installation URL
- Open a new tab to create a Personal Access Token in Rocket Chat
    - In the new tab open Rocket Chat
    - As a Rocket Chat admin go to "Profile -> My Account -> Security -> Personal Access Tokens"
    - Enter a name for the Personal Access Token and then hit Add
    - The Personal Access Token and the user Id will be generated 
- Copy the token and insert it back in the NextCloud settings tab in the Personal Access Token input, similar for the user Id
- Click the Submit button
- You will be redirected to the Rocket Chat app in NextCloud.
- Now you can access the Rocket Chat app from the navigation bar in NextCloud and open a new chat about a file by clicking the three dots icon and then clicking Messenger
- In order to add members to a chat about a file directly from the discussion view an admin must go to "Administration -> Layout -> Interface" and check "Show top navbar in embedded layout"  
- In order to change the Rocket Chat instance an admin can go to "Settings -> Administration -> Additional Settings" and then click the Reset Data button, this will remove the Rocket Chat URL, the Personal Access Token and the user Id from the database so you can change the Rocket Chat instance.

## Building the app

The app can be built by using the provided Makefile by running:

    make

This requires the following things to be present:
* make
* which
* tar: for building the archive
* curl: used if phpunit and composer are not installed to fetch them from the web
* npm: for building and testing everything JS, only required if a package.json is placed inside the **js/** folder

The make command will install or update Composer dependencies if a composer.json is present and also **npm run build** if a package.json is present in the **js/** folder. The npm **build** script should use local paths for build systems and package managers, so people that simply want to build the app won't need to install npm libraries globally, e.g.:

**package.json**:
```json
"scripts": {
    "test": "node node_modules/gulp-cli/bin/gulp.js karma",
    "prebuild": "npm install && node_modules/bower/bin/bower install && node_modules/bower/bin/bower update",
    "build": "node node_modules/gulp-cli/bin/gulp.js"
}
```


## Publish to App Store

First get an account for the [App Store](http://apps.nextcloud.com/) then run:

    make && make appstore

The archive is located in build/artifacts/appstore and can then be uploaded to the App Store.

## Running tests
You can use the provided Makefile to run all tests by using:

    make test

This will run the PHP unit and integration tests and if a package.json is present in the **js/** folder will execute **npm run test**

Of course you can also install [PHPUnit](http://phpunit.de/getting-started.html) and use the configurations directly:

    phpunit -c phpunit.xml

or:

    phpunit -c phpunit.integration.xml

for integration tests
