<?php


namespace Controller;

/**
 * Class FeedEvents
 * This is the controller that is responsible for handling submitted events (fixtures and match reports)
 * @package Controller
 */
class FeedEvents {

    /**
     * Receives the POSTed JSON data and persists the data in the app
     * @throws \Exception\JSONParseError If the app fails to parse the input as valid JSON
     * @throws \Exception\InvalidInputFormatError If the input JSON data is not of the expected format
     */
    public function process() {

        $data = json_decode(file_get_contents("php://input"), true);
        if (is_null($data)) {
            // Raise an exception if the posted data was not successfully parsed as JSON.
            // json_decode() will return NULL if the input JSON cannot be decoded:
            // http://php.net/manual/en/function.json-decode.php
            throw new \Exception\JSONParseError('Invalid input');
        }

        if (array_key_exists('type', $data[0])) {
            // We have received an array of events to process
            $this->process_events($data);
        } else {
            throw new \Exception\InvalidInputFormatError('Input data is not of the required format');
        }

        return 'Processed event(s)';

    }

    /**
     * Iterate through each event and process it
     * @param $events array A sequential array of events which has been provided in the request that are to be processed
     */
    private function process_events(array $events) {
        foreach ($events as $event) {
            $this->process_event($event);
        }
    }

    /**
     * @param $event_data array An associative array representing an event to be processed
     * @return \Model\Fixture | \Model\MatchReport The processed event
     * @throws \Exception\InvalidEventTypeError If the event is not of type 'fixture' or 'match_report'
     */
    private function process_event(array $event_data) {
        // Process the event, depending on whether the type is 'fixture' or 'match_report'
        switch (strtolower($event_data['type'])) {
            case 'fixture':
                $f = new \Model\Fixture();
                return $f->load($event_data)->store();
                break;
            case 'match_report':
                $r = new \Model\MatchReport();
                return $r->load($event_data)->store();
                break;
            default:
                throw new \Exception\InvalidEventTypeError();
        }
    }

}
