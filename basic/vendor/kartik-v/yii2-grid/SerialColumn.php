<?php

/**
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014
 * @package yii2-grid
 * @version 2.5.0
 */

namespace kartik\grid;

use Yii;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\base\InvalidConfigException;

/**
 * Extends the Yii's SerialColumn for the Grid widget [[\kartik\widgets\GridView]]
 * with various enhancements.
 *
 * SerialColumn displays a column of row numbers (1-based).
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
class SerialColumn extends \yii\grid\SerialColumn
{
    use ColumnTrait;
    
    /**
     * @var boolean whether the column is hidden from display. This is different 
     * than the `visible` property, in the sense, that the column is rendered,
     * but hidden from display. This will allow you to still export the column
     * using the export function.
     */
    public $hidden;
    
    /**
     * @var boolean|array whether the column is hidden in export output. If set to boolean `true`, 
     * it will hide the column for all export formats. If set as an array, it will accept the 
     * list of GridView export `formats` and hide output only for them.
     */
    public $hiddenFromExport = false;
    
    /**
     * @var string the horizontal alignment of each column. Should be one of
     * 'left', 'right', or 'center'.
     */
    public $hAlign = GridView::ALIGN_CENTER;

    /**
     * @var string the vertical alignment of each column. Should be one of
     * 'top', 'middle', or 'bottom'.
     */
    public $vAlign = GridView::ALIGN_MIDDLE;

    /**
     * @var boolean whether to force no wrapping on all table cells in the column
     * @see http://www.w3schools.com/cssref/pr_text_white-space.asp
     */
    public $noWrap = false;


    /**
     * @var string the width of each column (matches the CSS width property).
     * @see http://www.w3schools.com/cssref/pr_dim_width.asp
     */
    public $width = '50px';

    /**
     * @var boolean|string whether the page summary is displayed above the footer for this column.
     * If this is set to a string, it will be displayed as is. If it is set to `false` the summary
     * will not be calculated and displayed.
     */
    public $pageSummary = false;

    /**
     * @var string the summary function to call for the column
     */
    public $pageSummaryFunc = GridView::F_SUM;

    /**
     * @var array HTML attributes for the page summary cell
     */
    public $pageSummaryOptions = [];

    /**
     * @var boolean whether to just hide the page summary display but still calculate
     * the summary based on `pageSummary` settings
     */
    public $hidePageSummary = false;

    /**
     * @var boolean whether to merge the header title row and the filter row
     * This will not render the filter for the column and can be used when `filter`
     * is set to `false`. Defaults to `false`. This is only applicable when `filterPosition`
     * for the grid is set to FILTER_POS_BODY.
     */
    public $mergeHeader = true;

    /**
     * @var array of row data for the column for the current page
     */
    private $_rows = [];

    public function init()
    {
        $this->parseFormat();
        $this->parseVisibility();
        parent::init();
        $this->setPageRows();
    }
    
}