<?php
/**
 * This class handles the modification of a task object
 */
class Task {
    public $TaskId;
    public $TaskName;
    public $TaskDescription;
    protected $TaskDataSource;
    public function __construct($Id = null) {
        $this->TaskDataSource = file_get_contents('Task_Data.txt');
        if (strlen($this->TaskDataSource) > 0)
            $this->TaskDataSource = json_decode($this->TaskDataSource); // Should decode to an array of Task objects
        else
            $this->TaskDataSource = array(); // If it does not, then the data source is assumed to be empty and we create an empty array

        if (!$this->TaskDataSource)
            $this->TaskDataSource = array(); // If it does not, then the data source is assumed to be empty and we create an empty array
        if (!$this->LoadFromId($Id))
            $this->Create();
    }
    protected function Create() {
        // This function needs to generate a new unique ID for the task
        // Assignment: Generate unique id for the new task
        $this->TaskId = $this->getUniqueId();
        $this->TaskName = '';
        $this->TaskDescription = '';
    }
    protected function getUniqueId() {
        // Assignment: Code to get new unique ID
        return uniqid(); // Placeholder return for now
    }
    protected function LoadFromId($Id = null) {
        if ($Id) {
            // Assignment: Code to load details here...
            $taskIndex = array_search($this->TaskId, array_column($this->TaskDataSource, "TaskId"));
            return $taskIndex;
        } else
            return null;
    }

    public function Save() {
        //Assignment: Code to save task here
        array_push($this->TaskDataSource, array("TaskId"=> $this->TaskId ,"TaskName"=> $this->TaskName, "TaskDescription"=> $this->TaskDescription));
        $this->TaskDataSource = json_encode($this->TaskDataSource);
        $file = fopen('Task_Data.txt', "w") or die("Error: failed to open file!");
        fwrite($file, $this->TaskDataSource);
    }
    public function Delete() {
        //Assignment: Code to delete task here
        if ($index = $this->LoadFromId($this->TaskId)) {
            unset($this->TaskDataSource[$index]);
            $this->TaskDataSource = json_encode($this->TaskDataSource);
            $file = fopen('Task_Data.txt', "w") or die("Error: failed to open file!");
            fwrite($file, $this->TaskDataSource);
            return $index;
        }
    }
}
?>