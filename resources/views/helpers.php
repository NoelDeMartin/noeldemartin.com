<?php

if (! function_exists('blade_class')) {

    function blade_class(...$args)
    {
        $staticClasses = [];
        if (count($args) > 1) {
            $staticClasses[] = $args[0];
            $conditionalClasses = $args[1];
        } else {
            $conditionalClasses = $args[0];

        }

        foreach ($conditionalClasses as $class => $condition) {
            if ($condition) {
                $staticClasses[] = $class;
            }
        }

        $classString = implode(' ', $staticClasses);

        return "class=\"{$classString}\"";
    }

}

if (! function_exists('blade_icon')) {

    function blade_icon($name, $class = '', $attrs = [])
    {
        $attrsString = "class=\"{$class}\"";
        foreach ($attrs as $attr => $value) {
            $attrsString .= " {$attr}=\"{$value}\"";
        }
        return str_replace(':attrs', $attrsString, file_get_contents(resource_path("assets/icons/{$name}.svg")));
    }

}
