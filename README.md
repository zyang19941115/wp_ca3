# Overview
A simple game shop using PHP

# Modules
## Game Catalog
* game list page
> display all in used category, and display all games in selected category. 
If no category is selected, the latest category in the database will be selected by default. 
* game view page
> display game detail, include name, price, and picture.
if current user haven't bought this game, the `BUT IT` button will be displayed.
otherwise, page will display `You've already bought this game.`

## Game Manager
* game list manger page
> display in used category, and display all games in selected category. 
support edit or delete any game, or add game
* category list manger page
> display all category, support add category and delete category
* game add page 
> support add game
* game edit page
> display specific game detail and support edit game