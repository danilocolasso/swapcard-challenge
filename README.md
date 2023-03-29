Simple Email Application
===================

## Before install
Make sure you have installed Docker Desktop. If you don't, follow the <a href="https://www.docker.com/get-started" target="_blank">Get Started with Docker</a>.


## Installation guide

#### Clone the project
    $ git clone git@github.com:danilocolasso/swapcard-challenge.git

#### Enter project folder

    $ cd swapcard-challenge

#### Change the mailer settings on .env.sample to a valid one
    MAILER_HOST=
    MAILER_PORT=
    MAILER_USERNAME=
    MAILER_PASSWORD=

By default I left my data so it should work. But I advise you to change it.

#### Build the containers
    $ make build

**All done!** Everything should work wth a single command. The application will be available at
http://localhost/

## User guide
### Endpoints
There are only 2 endpoints:
- Create Email: http://localhost/email
- List Emails: http://localhost/email/list

### Tests
To run the tests, simply run the command

    make tests

## TO DO
- Use translations to avoid string messages on code
- Use RabbitMQ to send e-mails asynchronously
- Add more tests (only added basic tests)


<h4 align="center">
    Made with ♡ by <a href="https://www.linkedin.com/in/danilocolasso/" target="_blank">Danilo Colasso</a>
</h4>
