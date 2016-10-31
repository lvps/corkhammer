# Corkhammer
A simple static site generator. For those times when you need a corkscrew, but all you got is the [PHP hammer](https://www.flickr.com/photos/raindrift/7095238893/).

## Features\Bugs
- Simple almost to the point of unusability
- No dependencies
- Uses PHP itself as a templating language
- Requires PHP 7 for no good reason
- Not tested on Windows, but uses `DIRECTORY_SEPARATOR` everywhere
- Documentation (README.md) is as long as 1/4 of the code
- Can strip comments from CSS files as an attempt to minification.
With a regex. And it appears to work.

## How to...

### Build a website
1. Clone this repository
2. Place something in `input` directory or edit the example files: 
    * .html files should actually contain a JSON object of
    "metadata", the character sequence `---` on a line by itself and
    then some HTML content that will be placed inside a template
    * .css files will have their comments removed by a regex (this can be
    disabled from `config.php`)
    * All other files and directories will be copied to the `output`
    directory without further processing
3. Add some templates or edit the example one.
4. Edit config.php: here you can set the input\output directory names, some default
metadata including the default template, and also the rendering functions themselves.
5. Run `corkhammer.php` (or `php corkhammer.php`)
6. Your website will appear in the `output` directory

Renderable files are rendered every time, even if they haven't changed, as
templates or rendering functions themselves may have changed.

Empty folders won't be copied to output. Files deleted from input will
also be deleted from output.

Note that Corkhammer itself shouldn't be uploaded to a server, that dynamic
`include` in `config.php` is basically an `eval`...

### Write a template
Templates are normal PHP & HTML files that are called via `include`, and their
output is saved to a file. The whole point of the *PHP as a templating language*
thing is that you can write the ugliest and slowest code you can think
of, run it only once when rendering, and upload the resulting HTML.

There are a few variables available in a template:
* `$metadata`: contains whatever was in `$defaults` (in `config.php`) and, merged
over that, whatever was in the JSON "header" of the current input file.
* `$contents`: the part after `---` in input files
* `$innerpath`: the relative path to a file, without input\output folder.
E.g. `input/foo/bar.html` has `$innerpath = foo/bar.html`.

This description is about as long as the code implementing the functionality
itself, which is located in `config.php`.

### Write a rendering function
The `$render` array in `config.php` associates an extension with an
anonymous function: `function(string $innerpath, string $contents): string`.
Every time a file with that extension is encountered, the function is called.  
`$innerpath` is, again, the relative path; `$contents` is the entire
content of the file, the return value will be written to the output file.

Note that files can't be renamed, as `$innerpath` has to stay the same.
E.g. you can't render foo.md to foo.html.

If some html files need to be rendered and other don't, you can try to tell
them apart from their `$innerpath`, and "`return $contents;`" for those that
shouldn't be rendered.

## License
MIT.