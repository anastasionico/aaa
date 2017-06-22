<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function partial($name, $data, $loop = FALSE)
{
    if (strpos('/', $name) === FALSE)
    {
        $name = get_instance()->router->directory . get_instance()->router->class . '/_' . $name;
    }
    else
    {
        $parts = explode('/', $name); $last = count($parts) - 1;
        $parts[$last] = (strpos('_', $parts[$last]) === 0) ? $parts[$last] : '_' . $parts[$last];
        $name = implode('/', $parts);
    }

    $output = "";
    if ($loop && is_array($data))
    {
        foreach ($data as $row)
        {
            $output .= get_instance()->load->view($name, array( 'row' => $row ), TRUE);
        }
    }
    else
    {
        $output = get_instance()->load->view($name, array('data' => $data), TRUE); 
    }
    return $output; 
}
