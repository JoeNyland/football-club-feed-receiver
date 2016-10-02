# football-club-feed-receiver

Receives fixtures and match report data from a 3rd party aggregator.

# Requirements:
* PHP 5.5
* [Composer](https://getcomposer.org/download/)

## Setup
* Clone the repo
* `cd` into the cloned repo
* Install dependencies: `composer install`

## Running
* After setup, run `php -S localhost:8080 public/` to run the feed receiver

## Testing
* The app is designed to receive feed data on the endpoint `/feed/submit` using the HTTP `POST` method.
* An example of a fixture:
```
[{
    "type": "fixture",
    "created_at": "2016-10-02T17:47:26+00:00",
    "teams": ["Everton", "Liverpool"],
    "location": "Goodison Park",
    "kickoff": "2016-10-02T16:00:00+00:00",
    "result": [5, 0]
}]
```
* An example of a match report:
```
[{
    "type": "match_report",
    "created_at": "2016-10-02T17:47:26+00:00",
    "teams": ["Everton", "Liverpool"],
    "location": "Goodison Park",
    "kickoff": "2016-10-02T16:00:00+00:00",
    "result": [5, 0],
    "players": [
        ["Player 1", "...", "Player 11"],
        ["Player 1", "...", "Player 11"]
    ],
    "reports": [{
        "type": "goal",
        "player": "Player 1",
        "scored_at": "2016-10-02T16:01:56+00:00"
    }, {
        "type": "card",
        "color": "yellow",
        "player": "Player 1",
        "awarded_at": "2016-10-02T16:09:24+00:00"
    }]
}]
```
* For example, a fixture can be submitted like so:
```
curl -X POST --data '[{"type": "fixture", "created_at": "2016-10-02T17:47:26+00:00", "...": "..."}]' http://localhost:8080
```

## 3rd Party Libraries
The following 3rd party code libraries are used by this app:
* [Composer](https://getcomposer.org): Dependency Manager for PHP.
* [mrjgreen/phroute](https://github.com/mrjgreen/phroute): A super fast PHP router, with route parameters, restful controllers, filters and reverse routing.
