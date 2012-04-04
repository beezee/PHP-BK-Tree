class bkTree
{
    public $term;
    public $members;
    
    public function __construct($term)
    {
	$this->term = $term;
    }
    
    public function build(array $terms)
    {
	foreach($terms as $term)
	{
	    $this->addTerm($term);
	}
    }
    
    public function addTerm($t)
    {
        $d = levenshtein($this->term, $t);
	if ($this->members[$d]) $this->members[$d]->addTerm($t);
	else $this->members[$d] = new bkTree($t);
    }
    
    public function query($t, $l, $d=false, $r=false)
    {
	if (!$r) $r = new stdClass();
	$cd = levenshtein($this->term, $t);
	if ( $cd <= $l and $cd > 0 ) $r->matches[] = $this->term;
	if (!$d) $d = levenshtein($t, $this->term);
	for($i=$d-$l; $i<=$d+$l; $i++)
	{
	    if (isset($this->members[$i])) $this->members[$i]->query($t, $l, $d, $r);
	}
	return $r;
    }
}