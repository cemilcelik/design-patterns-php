<?php
echo "<h1>Observer</h1>";

class JobPost
{
    private $title;

    public function __construct(string $title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }
}

class JobSeeker implements SplObserver
{
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName():string
    {
        return $this->name;
    }

    public function update(SplSubject $jobPostings)
    {
        echo 'Hi ' . $this->name . '. New job posted: ' . $jobPostings->getJob()->getTitle();
        echo "<br>";
    }
}

class JobPostings implements SplSubject
{
    private $job;
    private $jobSeekers;

    public function addJob(JobPost $job)
    {
        $this->job = $job;
        $this->notify();
    }

    public function getJob(): JobPost
    {
        return $this->job;
    }

    public function attach(SplObserver $jobSeeker)
    {
        $this->jobSeekers[] = $jobSeeker;
    }

    public function detach(SplObserver $jobSeeker)
    {
        $key = array_search($jobSeeker, $this->jobSeekers, true);
        if ($key) {
            unset($this->jobSeekers[ $key ]);
        }
    }

    public function notify()
    {
        foreach ($this->jobSeekers as $jobSeeker) {
            $jobSeeker->update($this);
        }
    }
}

$johnDoe = new JobSeeker('John Doe');
$janeDoe = new JobSeeker('Jane Doe');
$joshDoe = new JobSeeker('Josh Doe');

$jobPosting = new JobPostings('Software Engineer');

$jobPosting->attach($johnDoe);
$jobPosting->attach($janeDoe);

$jobPosting->addJob(new JobPost('Software Engineer'));

$jobPosting->detach($janeDoe);
$jobPosting->attach($joshDoe);

$jobPosting->addJob(new JobPost('Database Engineer'));
