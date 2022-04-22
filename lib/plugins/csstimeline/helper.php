<?php
/** 
  * Helper Class for the csstimeline plugin
  */
  
// must be run within Dokuwiki
if(!defined('DOKU_INC')) die();

class helper_plugin_csstimeline extends DokuWiki_Plugin {

    public $specialPattern = '<csstimeline>.*?</csstimeline>';
    
    public function handleMatch($match)
    {
        $match = substr($match, 13, -14);
        $lines = explode("\n",$match);
        $data = array();
        $cnt = 0;
        $data['entries'] = array();
        foreach($lines as $line)
        {
            $line = trim($line);
            if($line)
            {
                $lineSplit = explode(':', $line, 2);
                switch(trim($lineSplit[0]))
                {
                    case '<entry>':
                        break;
                    case '</entry>':
                        $cnt++;
                        break;
                    case 'description':
                        $data['entries'][$cnt]['description'] = $this->render_text(trim($lineSplit[1]));
                        break;
                    default:
                        $data['entries'][$cnt][$lineSplit[0]] = hsc(trim($lineSplit[1]));
                        
                
                }
            }
        }
        return $data;
    }
  
}
