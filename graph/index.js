const { ApolloServer, gql } = require('apollo-server');
const fetch = require('node-fetch');

// A schema is a collection of type definitions (hence "typeDefs")
// that together define the "shape" of queries that are executed against
// your data.
const typeDefs = gql`
  type Movie {
    id: Int
    title: String
    overview: String
    releaseDate: String
    rating: Float
  }
  type TvShow {
    id: Int
    name: String
    overview: String
    firstAirDate: String
    rating: Float
  }
  type PopularStars {
    id: Int
    name: String
    popularity: Float
  }
  type Query {
    getMovies: [Movie],
    getTvShows: [TvShow],
    getPopularStars: [PopularStars]
  }
`;
const movieUrl = "http://localhost:9010/movies";
const popularStarsUrl = "http://localhost:9012/movies";
const tvShowUrl = "http://localhost:9011/movies";

const resolvers = {
  Query: {
    getMovies: async () => {
      return await fetch(`${movieUrl}`,{
        method: 'GET',
        headers: {
            'Accept': 'application/json'
        },
      }).then(res => res.json());
    },
    getPopularStars: async () => {
      return await fetch(`${popularStarsUrl}`,{
        method: 'GET',
        headers: {
            'Accept': 'application/json'
        },
      }).then(res => res.json());
    },
    getTvShows: async () => {
      return await fetch(`${tvShowUrl}`,{
        method: 'GET',
        headers: {
            'Accept': 'application/json'
        },
      }).then(res => res.json());
    }
  }
}


const server = new ApolloServer({ typeDefs, resolvers });

// The `listen` method launches a web server.
server.listen().then(({ url }) => {
  console.log(`🚀  Server ready at ${url}`);
});