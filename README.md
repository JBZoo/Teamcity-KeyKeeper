# JBZoo TeamcityKeyKeeper


```sh
teamcity-keykeeper key:save    --name="some_key_name" --value="some_value";
teamcity-keykeeper key:restore --name="some_key_name";
```

Output
```sh
##teamcity[setParameter name='env.some_key_name' value='some_value']
```


### License

MIT
