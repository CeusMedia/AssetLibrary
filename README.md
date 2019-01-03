# Asset Library
Library of composed assets for other applications.

## Purpose

### Situation
Hence you are creating web applications more than once.
You may need to include some third party libraries into the project, sort of:

- JavaScript libraries or components
- Stylesheets frameworks or components
- Icon sets
- Fonts

### Problem
Including these assets into project as bundled ressources may have some disadvantages:

- Server: using diskspace for redundant files (files are already installed for other projects)
- Client: user browser needs to download already known file since if other web app is using it 

### Solution
Build a central asset library for several web applications.

Using the template, you can create a common asset library to be used be several web apps.
By default, it holds some very basic ressources, like:

- CSS:
  - blueprint
  - Bootstrap
- JS, like:
  - jQuery
  - some jQuery plugins
  - CodeMirror
  - modernizr
  - mootools
  - prototype
  - TinyMCE
- Fonts:
  - Fira
  - FontAwesome
  - Hack
  - OpenSans
  - Roboto
  - Ubuntu
  - WorkSans
- Icon sets:
  - Glyphicons
  - famfamfam silk
  - famfamfam mini
  - famfamfam flags
  - tango

### Installation
````
git clone --recursive git@github.com:CeusMedia/AssetLibrary.git assets
````

### Update
````
cd assets
git submodule update --recursive --remote
````

