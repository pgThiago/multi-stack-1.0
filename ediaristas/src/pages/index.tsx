import { SafeEnvironment } from "@component/feedback/SafeEnvironment";
import { PageTitle } from "@component/data-display/PageTitle";
import { UserInformation } from "@component/data-display/UserInformation";
import { TextFieldMask } from "@component/Inputs/TextFieldMask";
import {
  Button,
  Container,
  Typography,
  CircularProgress,
} from "@material-ui/core";
import {
  FormElementsContainer,
  ProfissionaisPaper,
  ProfissionaisContainer,
} from "@styles/pages/index.style";
import { useIndex } from "data/hooks/pages/useIndex.pages";

export default function Home() {
  const {
    diaristas,
    diaristasRestantes,
    erro,
    buscaFeita,
    carregando,
    cep,
    setCep,
    cepValido,
    buscarProfissionais,
  } = useIndex();

  return (
    <div>
      <SafeEnvironment />
      <PageTitle
        title="Conheça os profissionais"
        subtitle="Preencha seu endereço e veja todos os profissionais da sua localidade"
      />

      <Container>
        <FormElementsContainer>
          <TextFieldMask
            mask="99.999-999"
            label="Digite seu CEP"
            fullWidth
            variant="outlined"
            value={cep}
            onChange={(event) => setCep(event.target.value)}
          />
          {erro && <Typography color="error">{erro}</Typography>}
          <Button
            variant="contained"
            color="secondary"
            sx={{
              width: "220px",
            }}
            disabled={!cepValido || carregando}
            onClick={() => buscarProfissionais(cep)}
          >
            {carregando ? <CircularProgress size={20} /> : "Buscar"}
          </Button>
        </FormElementsContainer>

        {buscaFeita &&
          (diaristas.length > 0 ? (
            <ProfissionaisPaper>
              <ProfissionaisContainer>
                {diaristas.map((diarista, i) => (
                  <UserInformation
										key={i}
                    name={diarista.nome_completo}
                    picture={diarista.foto_usuario}
                    rating={diarista.reputacao}
                    description={diarista.cidade}
                  />
                ))}
              </ProfissionaisContainer>

              <Container sx={{ textAlign: "center" }}>
                {diaristasRestantes > 0 && (
                  <Typography sx={{ mt: 5 }}>
                    ...e mais {diaristasRestantes}{" "}
                    {diaristasRestantes > 1
                      ? "profissionais atendem"
                      : "profissional atende"}
                    o seu endereço
                  </Typography>
                )}
                <Button variant="contained" color="secondary" sx={{ mt: 5 }}>
                  Contratar um profissional
                </Button>
              </Container>
            </ProfissionaisPaper>
          ) : (
            <Typography align="center" color="textPrimary">
              Ainda não temos diaristas disponíveis na sua região 😞
            </Typography>
          ))}
      </Container>
    </div>
  );
}
