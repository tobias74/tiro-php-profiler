<?php
namespace Tiro;

class Profiler
{
    protected $counters;
    protected $usedTimes;
    
    public function __construct()
    {
        $this->usedTimes = array();
        $this->counters = array();
    }
    
    protected function introduceProfilingId($profilingId)
    {
        $this->counters[$profilingId] = 0;
        $this->usedTimes[$profilingId] = 0; 
    }
    
    public function getHash()
    {
        $hash = array();
        foreach ($this->getProfilingIds() as $id)
        {
            $hash[$id] = array(
                'count' => $this->counters[$id],
                'usedTime' => $this->usedTimes[$id]
            );
        }
        return $hash;
    }
    
    protected function exists($profilingId)
    {
        if (isset($this->counters[$profilingId]))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    public function startTimer($profilingId)
    {
        return new ProfilerElement($profilingId, $this);
    }
    
    public function reportUsedTime($profilingId, $usedTime)
    {
        if (!$this->exists($profilingId))
        {
            $this->introduceProfilingId($profilingId);
        }
        
        $this->addTimeToProfilingId($profilingId, $usedTime);
    }
    
    protected function addTimeToProfilingId($profilingId, $usedTime)
    {
        $this->counters[$profilingId]++;
        $this->usedTimes[$profilingId] += $usedTime; 
    }
    
    public function getProfilingIds()
    {
        return array_keys($this->counters);
    }
    
    public function getCount($profilingId)
    {
        return $this->counters[$profilingId];
    }
    
    public function getUsedTime($profilingId)
    {
        return $this->usedTimes[$profilingId];
    }
}
