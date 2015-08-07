# autosatis

A little utility to automatically build a satis.json from a stub template and a list of composer.json files.

This can help you keep 'canonical' information in your composer.json(s) and not have to separately manage a satis.json.

## Install

Set up dependencies with `composer install`

## Usage

`bin/autosatis build <stub> <composerjson> (<composerjson> ...) > satis.json`

`<stub>` is expected to be a partial satis.json file. The `require` and `repositories` keys will be populated from the merged contents of the given `<composerjson>`(s).
