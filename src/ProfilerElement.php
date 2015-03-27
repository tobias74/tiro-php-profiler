<?php
namespace Tiro;

class ProfilerElement
{
    protected $startTime;
    protected $profiler;
    protected $profilingId;
    protected $elapsedTime;
    protected $hasBeenStoppedBefore = 0;
    
    public function __construct($profilingId, $profiler)
    {
        $this->profilingId = $profilingId;
        $this->profiler = $profiler;
        $this->startTime = microtime(true);
    }
    
    public function stop()
    {
        $usedTime = (microtime(true) - $this->startTime);
        
        if ($this->hasBeenStoppedBefore > 0)
        {
          $this->profiler->reportUsedTime($this->profilingId.' stoppage '.$this->hasBeenStoppedBefore, $usedTime);
        }
        else 
        {
          $this->profiler->reportUsedTime($this->profilingId, $usedTime);
        }
        
        
        $this->elapsedTime = $usedTime;
        
        
        
        $this->hasBeenStoppedBefore++;
        
    }
    
    public function getElapsedTime()
    {
        return $this->elapsedTime;
    }
        
}
