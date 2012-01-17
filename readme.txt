Uses levenshtein to query, finds similar words within a set of words. Benchmarked at about 20 seconds to build and run about 3k queries on a dictionary of 3k words.

Basic usage:

    $terms = array('term1', 'term2', 'etc') //must be unique values only
    $tree = new bkTree(array_pop($terms));
    $tree->build($terms);
    $r = $tree->query('term', 2) //term to find matches for, max levenshtein distance to search.
    
    
$r->matches will contain an array of any matches found based on the threshold passed to query();