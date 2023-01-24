# Projet Step and Go

Here is my project at the end of the training. I developed this site alone in 3 days at the Wild Code School.
I made some modifications afterwards, with help, to finish it and make it more operational. This site is fictitious.

I used the Symfony 5 Framework.

Step and Go is the name of a dance school for which I made a website, at the request of its director. This website was developed with the Symfony Framework. It includes a presentation of the school, details of the different dance styles offered, a brief description of the teachers, as well as the prices. It also displays a detailed schedule of classes, and a contact form allowing users to reach the director. 

Concerning the front-end, I set up a navigation bar to reach each page (with a drop-down menu for the dance classes and the teachers). On the presentation page of the school, a carousel allows you to scroll through photos. A dynamic weekly schedule displays the dance classes and events organized throughout the year. One of the objectives was that the site be visually colorful, but also responsive and ergonomic. 

For the back-end part, the director is the only administrator of the site. The interface allows her to log in and to have special tabs to manage the dance classes, the teachers, and the events schedule (add, modify, delete). Messages sent by users via the contact form are also visible from this administrator area. The director not knowing the computer code, the back-end part had to be easy to use and intuitive. 

Feel free to clone to test!

![accueil_step_and_go](https://user-images.githubusercontent.com/76404051/214405194-f889335b-782c-4382-9bdc-23b6078636ce.png)

Prerequisites
    Check composer is installed
    Check yarn & node are installed
    Check symfony 5 is installer

Install
    Clone this project
    Run composer install
    Run yarn install
    Run yarn encore dev to build assets

Working
    Run symfony server:start to launch your local php web server
    Run yarn run dev --watch to launch your local server for assets (or yarn dev-server do the same with Hot Module Reload activated)

Windows Users
If you develop on Windows, you should edit you git configuration to change your end of line rules with this command:

git config --global core.autocrlf true

The .editorconfig file in root directory do this for you. You probably need EditorConfig extension if your IDE is VSCode.
Run locally with Docker
    Fill DATABASE_URL variable in .env.local file with DATABASE_URL="mysql://root:password@database:3306/<choose_a_db_name>"
    Install Docker Desktop an run the command:

docker-compose up -d
    Wait a moment and visit http://localhost:8000
