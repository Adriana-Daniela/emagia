# eMagia

## Documentation
This is a sample of a fantasy game played by a hero and a beast in the ever-green forests of Emagia.
More details of the game rules can be found in the attached .pdf file.

## Quickstart Installation

1. Run `git clone https://github.com/Adriana-Daniela/emagia.git`.
2. Start docker containers with `docker-compose up --build -d`.
3. Navigate to your `http://localhost:80` and you should already see battle statistics.

## Usage
You should see on the browser a simple battle report that tells you how the creatures were fighting on each turn.
You will see who started the fight and what damage will cause to the defender. And you will see if any magic skills were used.
The Strike Skill is used by both players and is always active.

## Run phpUnit tests
1. Bash into the php container with: `docker-compose exec -it php /bin/bash`.
2. Run all tests with `./vendor/bin/phpunit tests`
3. Battle sample report:
   ![Battle sample report](https://github.com/Adriana-Daniela/emagia/blob/master/Battle-report.png?raw=true "Title")
