<?php
class Pagination
{
    private $totalRecords;
    private $currentPage;
    private $totalRecordsByPage;
    private $numberLinks = 5;

    public function __construct($totalRecords, $totalRecordsByPage, $currentPage)
    {
        $this->totalRecords = (int) $totalRecords;
        $this->totalRecordsByPage = (int) $totalRecordsByPage;
        $this->currentPage = (int) $currentPage;

        $totalPages = $this->getTotalPages();

        if ($this->currentPage > $totalPages && $this->currentPage > 1) {
            $this->currentPage = $totalPages;
        }
    }

    public function getTotalPages()
    {
        return (int) ceil($this->totalRecords / $this->totalRecordsByPage);
    }  

    public function getPreviousPage()
    {
        if ($this->currentPage > 1) {
            return ($this->currentPage - 1);
        }

        if ($this->getTotalPages() == 0) {
            return 0;
        }

        return 1;
    } 

    public function getNextPage()
    {
        if ($this->currentPage < $this->getTotalPages()) {
            return ($this->currentPage + 1);
        }
        return $this->getTotalPages();
    }

    public function getMinPage()
    {
        $totalPages = $this->getTotalPages();

        if ($totalPages == 0) {
            return $totalPages;
        }

        $min = 1;

        if ($totalPages > $this->numberLinks) {
            $med = ceil($this->numberLinks / 2 );

            if (($this->currentPage - $med) > 0) {
                $min = ($this->currentPage - $med);
            } else {
                $min = 1;
            }
        }

        return (int) $min;
    }

    public function getMaxPage()
    {
        $totalPages = $this->getTotalPages();

        if ($totalPages == 0) {
            return $totalPages;
        }

        $min = $this->getMinPage();
        $max = $totalPages;

        if ($totalPages > $this->numberLinks) {
            $max = ($min + $this->numberLinks) - 1;
            
            if ($max > $totalPages) {
                $max = $totalPages;
            }
        }

        return (int) $max;
    }

    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    public function getTotalRecords()
    {
        return $this->totalRecords;
    }
}