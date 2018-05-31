# Simple NuGet Server

A very simple NuGet server for my personal use, similar to
[NuGet.Server](https://www.nuget.org/packages/NuGet.Server) but in PHP. Designed
for scenarios where a single user (ie. a person or a build server) pushes
packages.

## Features

- Basic searching and listing of packages
- Pushing via NuGet command line (NuGet.exe)
- Simple set up
- Stores data in SQLite or MySQL database
- Uses a single API key (so not suitable for scenarios where multiple users need to be able to push packages)

## Setup

### With docker

```bash
docker pull agowa338/docker-nuget-server
api_key = `openssl rand -base64 32`
docker run -d --name nuget-server -p 80:80 -e NUGET_API_KEY=$api_key agowa338/docker-nuget-server
```

Note: It is recommended, to place this nuget server behind a tls offloading server, so all requests are served over https, or you make yourself vulnerable to MITM attacks.

### Without docker

For a Debian-based distro (including Ubuntu), installation is something along the lines of what I've written below. Installation using other Linux distributions will vary but it should be pretty similar.

1. Ensure all dependencies are installed:

- A web server (Nginx, Apache, Cherokee, etc.)
- PHP 7, PHP 5.4+ or HHVM
- SQLite, XML, and Zip extensions (bundled with HHVM, or `apt-get install php5-sqlite` for PHP 5, or `apt-get install php7.0-sqlite php7.0-xml php7.0-zip` for PHP 7)

Note: If using Nginx, please make sure `ngx_http_dav_module` is installed. This is required to enable HTTP `PUT` support.

2. Copy app to your server, you could do a Git clone on the server or add it as a Git submodule if adding to a site that's already managed via Git:

```bash
cd /var/www
git clone https://github.com/agowa338/simple-nuget-server.git
# Make db and packages directories writable
chown www-data:www-data db packagefiles
chmod 0770 db packagefiles
```

3. Copy nginx.conf.example to `/etc/nginx/sites-available/nuget` and modify it for your environment:

- Change `example.com` to your domain name
- Change `/var/www/simple-nuget-server/` to the checkout directory
- Change "php" to the name of a PHP upstream in your Nginx config. This can be regular PHP 5.4+ or HHVM.
- If hosting as part of another site, prefix everything with a subdirectory and combine the config with your existing site's config (see ReactJS.NET config at the end of this comment)

4. Edit `inc/config.php` and change `ChangeThisKey` to a [randomly-generated string](https://www.random.org/strings/)

5. Enable the site (if creating a new site)

```bash
ln -s /etc/nginx/sites-available/nuget /etc/nginx/sites-enabled/nuget
/etc/init.d/nginx reload
```

## Examples

Set the API key and test it out.

- [nuget Binary](https://docs.nuget.org/consume/command-line-reference) (which is required for pushing)

```bash
nuget setApiKey -Source http://example.com/ ChangeThisKey
nuget push Foo.nupkg -Source http://example.com/
```

- PowerShell Native or Core (using PowerShellGet)

```powershell
Register-PSRepository -Name MyRepossitory -SourceLocation http://example.com/ -PublishLocation http://example.com/ -ScriptSourceLocation http://example.com/ -ScriptPublishLocation http://example.com/ -InstallationPolicy Trusted
Publish-Module -NuGetApiKey ChangeThisKey -Name YourModuleToUpload -Repository MyRepossitory
Find-Module -Repository MyRepossitory
```

## Licence

(The MIT licence)

Copyright (C) 2014 Daniel Lo Nigro (Daniel15)
Copyright (C) 2018 Klaus Frank (agowa338)

Permission is hereby granted, free of charge, to any person obtaining a copy of
this software and associated documentation files (the "Software"), to deal in
the Software without restriction, including without limitation the rights to
use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies
of the Software, and to permit persons to whom the Software is furnished to do
so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
