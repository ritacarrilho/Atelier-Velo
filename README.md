# atelier-velo

# Table of contents
* [General Info](#general-info)
* [Technologies](#technologies)
* [Back End](#back-end)
* [Api](#api)
* [Front End](#front-end)
* [Pages](#pages)

# General Info
Web site for Bicycle Atelier, nonprofit organization. Dev environment: Docker and Lando.

# Technologies:
* Symfony
* Twig
* SASS and SCSS
* MySQL
* Api Platform
* React
* Docker
* Lando

# Back End
Back end developed in Symfony, Database in MySQL, Back Office using the bundle Easy Admin and security system. SignIn form made with Twig and styled with SASS.
Creation of accounts to login the back Office, access to data restricted according to type of user. 
Possibility to insert, delete and edit data (CRUD) and customized menu

### Admin User Access: 
* Crud products
* Crud events
* Crud services
* Crud subscribers
* Crud accounts

### Volunteer User Access: 
* Crud products
* Crud events
* Crud services
* Crud subscribers

# Api
API Rest developed with framework Api Platform, entities added to Api with the Symfony bundle Doctrine Annotation. 
Public Api with only Get method (for now), so no external person can add, delete or edit the data. 
Only the id of subscribers was added to the API so their data remains private.

# Front End
Front end developed in React and styled with SCSS. Development of components and requests made with library Axios.

# Pages 
### Homepage: 
* Atelier's presentation
* Counter of subscribers and repaired bicycles
* Last inserted bicycles to sell
* Next events

### Nos produits: 
* List of all types of products
* List of bicycles available to buy at the workshop
* Pagination of 10 bicycles at a time
* Filter of bycicles according to the model and size

### Nos Evénements: 
* List of all events, ordered by date
* Pagination of 10 events at a time
* Filter of events according to the category

### Nos Services: 
* List of all services

### L'atelier: 
* Presentation of 'atelier participatif' and the organization
* How to become a volunteer
* Team presentation
* Contacts
